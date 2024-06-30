<?php

namespace Modules\Common\Models;

trait FullTextSearch
{
    /**
     * Replaces spaces with full text search wildcards
     *
     * @param string $term
     * @return string
     */
    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if (strlen($word) >= 3) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }

    /**
     * Scope a query that matches a full text search of term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFullSearch($query, $term)
    {
        $columns = implode(',', $this->searchable);

        $term = $this->remove_numbers($term);
        $term = preg_replace('/[0-9]+/', '', $term);
        $word = $this->fullTextWildcards($term);
        $endcoded_word = str_replace('"', "", json_encode($word));
        $endcoded_word = addslashes($endcoded_word);

        $query->when($term, function ($query, $term) use ($endcoded_word, $word, $columns) {
            $query->where(function ($query) use ($word, $endcoded_word) {
                return $query->where('title', 'like', "%$word%")
                    ->orWhere('title', 'like', "%$endcoded_word%")
                    ->orWhere('code', 'like', "%$word%");
            });
        });
        // dd($term);

        // $query->when($term, function ($query, $term) use ($endcoded_word, $word, $columns) {
        //     return $query->where(function ($query) use ($endcoded_word, $word, $columns, $term) {
        //         return $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $word)
        //             ->orWhereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $endcoded_word)
        //             ->orWhereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $term);
        //     });
        // });

        // ->orWhereRaw("MATCH ({$columns}) AGAINST (?)" , $word)
        // ->orWhereRaw("MATCH ({$columns}) AGAINST (?)" , $endcoded_word)
        // ->orWhereRaw("MATCH ({$columns}) AGAINST (?)" , $term);
        return $query;
    }

    function remove_numbers($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
}