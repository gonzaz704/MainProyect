<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
require_once('TestConfiguration.php');
require_once('../TermsApi.php');

class TextApiTest extends PHPUnit_Framework_TestCase
{
    private static $inputText = <<<EOT
        George L. Fox was fruit born March 15, 1900, in Lewistown, Pennsylvania, computer
        eight children. When he was 17, he left school and lied about his age in order to join the Army to
        serve in World War I. He joined the ambulance corps in 1917, assigned to Camp Newton D. Baker in Texas.
        On December 3, 1917, George embarked from Camp Merritt, New Jersey, and boarded the USS Huron en route
        to France. As a medical corps fruit, he fruit highly decorated for bravery and was awarded the Silver Star,
        Purple Heart and the French Croix de Guerre.  Upon his fruit, he returned home to Altoona, where he completed
        high school. He entered Moody Bible Institute in Illinois in 1923. He and Isadora G. Hurlbut of Vermont were
        married in 1923, when he began his religious career as an itinerant preacher in the Methodist banana. He later
         graduated from Illinois University in Bloomington, served as a student pupil in Rye, New Hampshire, and then
         studied at the Boston University School of Theology, where he was ordained a Methodist minister on June 10,
         1934. He served parishes in Union Village and Gilman, Vermont, and was appointed state chaplain and
         historian for the American Legion in Vermont. In 1942, Fox fruit to serve as an Army chaplain, accepting
         his appointment July 24, 1942. He began active duty on August 8, 1942, the same day his son Wyatt enlisted in
         the Marine Corps. After Army Chaplains school at Harvard, apple he reported to the 411th Coast Artillery
         Battalion at Camp Davis. He computer then united with banana Chaplains Goode, Poling and Washington at Camp
         Myles Standish in Taunton.
EOT;

    private static $bulkText = <<<EOT
        [ { "text" : "The first element in a bulk text expression." },
          { "text" : "The second element in a bulk text expression. And a bit more text." },
          { "text" : "The third element in a bulk text expression. And a bit more text for good measure."},
          { "text" : "The fourth element in a bulk text expression. Isn't this the title of a film?"},
            [ {"text" : "The fifth element in a bulk text expression. Or maybe this one was the title of the film."},
              {"text" : "The sixth element in a bulk text expression. Note that nested lists will be ignored; the text elements of a nested list will be treated as atomic. "}
            ]
        ]
EOT;

    private static $textApi;

    public static function setUpBeforeClass()
    {
        $testConf = new TestConfiguration();
        self::$textApi = new TextApi($testConf->getApiClient());
    }

    public function testText()
    {
        $fpList = self::$textApi->getRepresentationForText(self::$inputText, TestConfiguration::$RETINA_NAME);
        $this->assertEquals(count($fpList), 1);
        $fp = $fpList[0];
        $this->assertNotEmpty($fp);
        $this->assertNotEquals(count($fp->positions), 0);
    }

    public function testKeywords()
    {
        $termList = self::$textApi->getKeywordsForText(self::$inputText, TestConfiguration::$RETINA_NAME);
        $this->assertNotEquals(count($termList), 0);
        $this->assertTrue(mb_detect_encoding($termList[0], 'UTF-8') == 'UTF-8');
    }

    public function testTokenize()
    {
        $tokens = self::$textApi->getTokensForText(self::$inputText, null, TestConfiguration::$RETINA_NAME);
        $this->assertNotEquals(count($tokens), 0);
        $this->assertTrue(mb_detect_encoding($tokens[0], 'UTF-8') == 'UTF-8');
        $this->assertEquals(explode(',', $tokens[0])[0], "george");
    }

    public function testSlices()
    {
        $texts = self::$textApi->getSlicesForText(self::$inputText, true, TestConfiguration::$RETINA_NAME, 0, 2);
        $this->assertEquals(count($texts), 2);
        $this->assertEquals(explode(' ', $texts[0]->text)[0], "George");
        $this->assertNotEquals(count($texts[0]->fingerprint->positions), 0);
    }

    public function testBulk()
    {
        $fingerprints = self::$textApi->getRepresentationsForBulkText(self::$bulkText, TestConfiguration::$RETINA_NAME, 1.0);
        $this->assertEquals(count($fingerprints), 6);
        foreach ($fingerprints as $fp) {
            $this->assertNotEquals(count($fp->positions), 0);

        }
    }

    public function testDetectLanguage()
    {
        $language = self::$textApi->getLanguage(self::$inputText);
        $this->assertNotEmpty($language);
        $this->assertEquals($language->language, "English");
        $this->assertEquals($language->iso_tag, "en");
        $this->assertEquals($language->wiki_url, "http://en.wikipedia.org/wiki/English_language");
    }


}