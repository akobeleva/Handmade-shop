<?php

require_once 'Morphy.php';

class SearchCore
{
    private $morphy;

    public function __construct()
    {
        $this->morphy = new Morphy();
    }

    /**
     * Do text indexing
     *
     * @param string $content Text for indexing
     * @param int    $range   Significance coefficient of the indexed data
     *
     * @return stdClass
     */
    public function makeIndex(string $content, int $range = 1): stdClass
    {
        $index = new stdClass();
        $index->range = $range;
        $index->words = [];

        // Getting words from text //
        $words = $this->morphy->getWords($content);

        foreach ($words as $word) {
            // Evaluating the significance of a word //
            $weight = $this->morphy->weigh($word);

            if ($weight > 0) {
                $length = count($index->words);

                //Checking the existence of the word in the index //
                for ($i = 0; $i < $length; $i++) {
                    if ($index->words[$i]->source === $word) {
                        $index->words[$i]->count++;
                        $index->words[$i]->range
                            = $range * $index->words[$i]->count
                            * $index->words[$i]->weight;

                        // Next word //
                        continue 2;
                    }
                }

                //If the word is not yet in the index //
                $lemma = $this->morphy->lemmatize($word);

                if ($lemma) {
                    // Checking for lemmas in the index //
                    for ($i = 0; $i < $length; $i++) {
                        // If there are lemmas //
                        if ($index->words[$i]->basic) {
                            $difference = count(
                                array_diff($lemma, $index->words[$i]->basic)
                            );

                            // If a word has less than two distinct lemmas //
                            if ($difference === 0) {
                                $index->words[$i]->count++;
                                $index->words[$i]->range
                                    = $range * $index->words[$i]->count
                                    * $index->words[$i]->weight;

                                // Next word //
                                continue 2;
                            }
                        }
                    }
                }

                // Adding a word to index
                $node = new stdClass();
                $node->source = $word;
                $node->count = 1;
                $node->range = $range * $weight;
                $node->weight = $weight;
                $node->basic = $lemma;

                $index->words[] = $node;
            }
        }

        return $index;
    }

    /**
     * @param $target
     * @param $index
     *
     * @return int|mixed
     */
    public function search($target, $index)
    {
        $total_range = 0;

        // Search query words //
        foreach ($target->words as $target_word) {
            // Search index words //
            foreach ($index->words as $index_word) {
                if ($index_word->source === $target_word->source) {
                    $total_range += $index_word->range;
                } elseif ($index_word->basic && $target_word->basic) {
                    //If the searched and indexed words have lemmas //
                    $index_count = count($index_word->basic);
                    $target_count = count($target_word->basic);

                    for ($i = 0; $i < $target_count; $i++) {
                        for ($j = 0; $j < $index_count; $j++) {
                            if ($index_word->basic[$j]
                                === $target_word->basic[$i]
                            ) {
                                $total_range += $index_word->range;
                                continue 2;
                            }
                        }
                    }
                }
            }
        }
        return $total_range;
    }
}