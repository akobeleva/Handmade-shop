<?php

require_once 'libs/phpmorphy/src/common.php';

class Morphy
{
    private $phpmorphy;
    private $regexp_word = '/([a-zа-я0-9]+)/ui';
    private $regexp_entity = '/&([a-zA-Z0-9]+);/';

    public function __construct()
    {
        $directory = 'libs/phpmorphy/dicts';
        $language = 'ru_RU';
        $options['storage'] = PHPMORPHY_STORAGE_FILE;
        // Library initialization //
        $this->phpmorphy = new phpMorphy($directory, $language, $options);
    }

    /**
     * Breaks text into words
     *
     * @param string $content incoming text
     * @param bool   $filter  filter activation of HTML-tags and HTML-entities
     */
    public function getWords(string $content, bool $filter = true)
    {
        // Filtration of HTML-tags and HTML-entities
        if ($filter) {
            $content = strip_tags($content);
            $content = preg_replace($this->regexp_entity, ' ', $content);
        }
        $content = mb_strtoupper($content, 'UTF-8');
        $content = str_ireplace('Ё', 'Е', $content);
        preg_match_all($this->regexp_word, $content, $words_src);
        return $words_src[1];
    }

    /**
     * Finds lemmas of word
     *
     * @param string $word incoming word
     *
     * @return array|false   array of possible lemmas of the word or false
     */
    public function lemmatize(string $word)
    {
        // Getting the basis form of the word
        return $this->phpmorphy->lemmatize($word);
    }

    /**
     * Evaluates the significance of the word
     *
     * @param string $word
     * @param false  $profile
     *
     * @return int|mixed
     */
    public function weigh(string $word, bool $profile = false)
    {
        $partsOfSpeech = $this->phpmorphy->getPartOfSpeech($word);

        if (!$profile) {
            $profile = [
                // Service parts of speech //
                'ПРЕДЛ'   => 0,
                'СОЮЗ'    => 0,
                'МЕЖД'    => 0,
                'ВВОДН'   => 0,
                'ЧАСТ'    => 0,
                'МС'      => 0,

                // The most significant parts of speech //
                'С'       => 5,
                'Г'       => 5,
                'П'       => 3,
                'Н'       => 3,

                // Others parts of speech //
                'DEFAULT' => 1
            ];
        }

        if (!$partsOfSpeech) {
            return $profile['DEFAULT'];
        }

        $range = [];

        for ($i = 0; $i < count($partsOfSpeech); $i++) {
            if (isset($profile[$partsOfSpeech[$i]])) {
                $range[] = $profile[$partsOfSpeech[$i]];
            } else {
                $range[] = $profile['DEFAULT'];
            }
        }
        return max($range);
    }
}