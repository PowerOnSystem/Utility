<?php

/*
 * Copyright (C) PowerOn Sistemas
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace PowerOn\Utility;

/**
 * Inflector
 * @author Lucas Sosa
 * @version 0.1
 */
class Inflector {
    /**
     * Singulariza una palabra
     * @param string $text
     * @return string
     */
    public static function singularize($text) {
        if (is_string($text)) {
            $word = $text;
        } else if (!$word = $text['word']) {
            return false;
        }
        
        $singular = array (
            '/(quiz)zes$/i' => '\\1',
            '/(matr)ices$/i' => '\\1ix',
            '/(vert|ind)ices$/i' => '\\1ex',
            '/^(ox)en/i' => '\\1',
            '/(alias|status)es$/i' => '\\1',
            '/([octop|vir])i$/i' => '\\1us',
            '/(cris|ax|test)es$/i' => '\\1is',
            '/(shoe)s$/i' => '\\1',
            '/(o)es$/i' => '\\1',
            '/(bus)es$/i' => '\\1',
            '/([m|l])ice$/i' => '\\1ouse',
            '/(x|ch|ss|sh)es$/i' => '\\1',
            '/(m)ovies$/i' => '\\1ovie',
            '/(s)eries$/i' => '\\1eries',
            '/([^aeiouy]|qu)ies$/i' => '\\1y',
            '/([lr])ves$/i' => '\\1f',
            '/(tive)s$/i' => '\\1',
            '/(hive)s$/i' => '\\1',
            '/([^f])ves$/i' => '\\1fe',
            '/(^analy)ses$/i' => '\\1sis',
            '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\\1\\2sis',
            '/([ti])a$/i' => '\\1um',
            '/(n)ews$/i' => '\\1ews',
            '/s$/i' => ''
        );
        $irregular = array(
            'person' => 'people',
            'man' => 'men',
            'child' => 'children',
            'sex' => 'sexes',
            'move' => 'moves'
        );	
        $ignore = array(
            'equipment',
            'information',
            'rice',
            'money',
            'species',
            'series',
            'fish',
            'sheep',
            'press',
            'sms',
        );
        $lower_word = strtolower($word);
        foreach ($ignore as $ignore_word) {
            if (substr($lower_word, (-1 * strlen($ignore_word))) == $ignore_word) {
                return $word;
            }
        }
        foreach ($irregular as $singular_word => $plural_word) {
            if (preg_match('/('.$plural_word.')$/i', $word, $arr)) {
                return preg_replace('/('.$plural_word.')$/i', substr($arr[0],0,1).substr($singular_word,1), $word);
            }
        }
        
        foreach ($singular as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }
        
        return $word;
    }
    
    /**
     * Pluraliza una palabra
     * @param string $text
     * @return string
     */
    public static function pluralize($text) {
        $last_letter = strtolower($text[strlen($text)-1]);
        switch ($last_letter) {
            case 'y'    : $return = substr($text, 0, -1) . 'ies'; break;
            case 's'    : $return = $text . 'es'; break;
            default     : $return = $text . 's'; break;
        }
        return $return;
    }
    
    /**
     * Cameliza una palabara quitando _ y capitalizando siguiente letra
     * @param string $word
     * @param string $delimiter
     * @return string
     */
    public static function camelize($word, $delimiter = '_') {
        $elements = explode($delimiter, $word);

        for ($i = 0; $i < count($elements); $i++) {
            if (0 == $i) {
                $elements[$i] = strtolower($elements[$i]);
            } else {
                $elements[$i] = strtolower($elements[$i]);
                $elements[$i] = ucwords($elements[$i]);
            }
        }

        return implode('', $elements);
    }
    
    public static function mixify($word, $delimiter = '_') {
        $lower = strtolower($word);
        $upper = ucwords($lower, $delimiter);
        return str_replace($delimiter, '', $upper);
    }
    
    /**
     * Convierte una palabra en formato de clase
     * @param string $text
     * @return string
     */
    public static function classify($text) {
        return preg_replace('/ /', '', ucwords(preg_replace('/_/', ' ', $text)));
    }
}
