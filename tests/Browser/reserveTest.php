<?php

namespace Tests\Browser;

use Laravel\Dusk\Chrome;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Log;
use Laravel\Dusk\Browser;

use function Laravel\Prompts\pause;
use thiagoalessio\TesseractOCR\TesseractOCR;
use App\Models\Config;

class reserveTest extends DuskTestCase
{
    private function solveCaptcha($browser)
    {
        // گرفتن تصویر کپچا با URL کامل
        $captchaImage = $browser->element('#CaptchaImgLoginjson')->getAttribute('src');
        $fullUrl = 'https://110129.samanpl.ir' . $captchaImage;
        
        // ذخیره تصویر موقت
        $tempImage = tempnam(sys_get_temp_dir(), 'captcha') . '.png';
        file_put_contents($tempImage, file_get_contents($fullUrl));
        
        // استفاده از Tesseract برای تشخیص اعداد
        $text = (new TesseractOCR($tempImage))
            ->lang('eng')
            ->digits() // فقط اعداد رو تشخیص بده
            ->psm(7) // حالت تشخیص تک خط
            ->oem(3) // حالت تشخیص خودکار
            ->run();
            
        // پاک کردن فایل موقت
        unlink($tempImage);
        
        // فقط اعداد رو نگه دار و بقیه کاراکترها رو حذف کن
        $numbers = preg_replace('/[^0-9]/', '', $text);
        
        // وارد کردن پاسخ کپچا
        $browser->type('#CaptchaName', $numbers);
    }

    public function testBasicExample()
    {
        $this->browse(function ($browser) {
            $config = Config::first();
            if ($config->status == 0) {
                $this->markTestSkipped('سیستم غیرفعال است یا تنظیمات وجود ندارد.');
                return;
            }

            $jalali = Jalalian::fromCarbon(Carbon::now());
            $year = $jalali->getYear();
            $month = sprintf('%02d', $jalali->getMonth());
            $day = $jalali->getDay();
            $date = $year . $month . ($day + 1);
            $browser->visit('https://110129.samanpl.ir/Home/Index')
                ->waitFor('a[data-target="#exampleModal"]')->click('a[data-target="#exampleModal"]')
                ->pause(2000)
                ->type('#UName', $config->username)
                ->type('#Passwordfield', $config->password)
                ->waitFor('#loginButton')
                ->pause(1000);
                
            $displayStyle = $browser->element('.row.captchaDisplay')->getAttribute('style');
            if (strpos($displayStyle, 'display: none') === false) {
                $this->solveCaptcha($browser);
            }

            $browser->click('#loginButton')
                ->pause(10000);
            $href = $browser->script("return document.querySelector(\"a.btn.btn-info[target='_blank']\")?.getAttribute('href');")[0];

            if ($href) {
                $url = 'https://110129.samanpl.ir' . $href;
                $browser->visit($url);
            }

            $browser->waitFor('#StartDate1')->click('#StartDate1')
                ->waitFor("td[data-day][data-number='$date']")
                ->pause(2000)
                ->click("td[data-day][data-number='$date']")
                ->pause(2000);
            $browser->script("
                window.selectedDate = {$date};
                window.rangeSelector = {$date}; ");

            for ($i=8; $i <18 ; $i=$i+3) { 
                $windows = $browser->driver->getWindowHandles();
                $browser->driver->switchTo()->window(reset($windows));
                $browser->pause(1000);
                $windowsBefore = count($browser->driver->getWindowHandles());
                $browser->waitFor("button.col-2.btn[id='{$i}']")
                    ->click("button.col-2.btn[id='{$i}']");
                $browser->pause(3000);
                $windowsAfter = count($browser->driver->getWindowHandles());
                if ($windowsAfter > $windowsBefore) {
                    $windows = $browser->driver->getWindowHandles();
                    $browser->driver->switchTo()->window(end($windows));
                    $browser->pause(2000);

                    $elements = [
                        $browser->element('div[id="' . $config->seat_one . '"]'),
                        $browser->element('div[id="' . $config->seat_two . '"]'), 
                        $browser->element('div[id="' . $config->seat_three . '"]')
                    ];

                    foreach ($elements as $element) {
                        $hasReserveClass = str_contains($element->getAttribute('class'), 'reserve');
                        
                        if (!$hasReserveClass) {
                            $elementId = $element->getAttribute('id');
                            $browser->click("div[id='$elementId']");
                            break;
                        }
                    }

                    $browser->pause(3000);
                    $browser->waitFor('#btnReserve')
                        ->click('#btnReserve');
                    $browser->pause(3000);
                    $browser->waitFor('.confirm')
                        ->click('.confirm')
                        ->pause(2000);
                }
            }
        });
    }
}
