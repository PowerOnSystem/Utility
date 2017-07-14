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
 * Str
 * @author Lucas Sosa
 * @version 0.1
 * @copyright (c) 2016, Lucas Sosa
 */
class Str {

    /**
     * Formatea un integer en bytes
     * @param integer $bytes Bytes
     * @param integer $precision [Opcional] La precision en decimales (2 por defecto)
     * @return string La cadena formateada
     */
    public static function bytestostr($bytes, $precision = 2) {
        $base = log($bytes, 1024);
        $suffixes = ['B', 'K', 'M', 'G', 'T'];

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }
    
    /**
     * Corta una cadena en palabras
     * @param string $words
     * @param integer $limit
     * @return string
     */
    public static function wordscut($words, $limit = 10) {
        $array_words = explode(' ', $words);
        $count = 0;
        $result = array();
        foreach ($array_words as $a) {
            $count += strlen($a) + 1;
            $result[] = $a;
            if ( $count >= $limit ) {
                break;
            }
        }

        return implode(' ', $result);
    }
    
    /**
     * Junta de forma natural un array Ej: <code>natjoin(['coca', 'pepsi', 'fanta']) //Mostraría coca, pepsi y fanta</code>
     * @param array $options Array con opciones a juntar
     * @param string $join_string Lenguaje del último resultado por defecto es y
     * @return string
     */
    public static function natjoin(array $options, $join_string = 'y') {
        $last  = array_slice($options, -1);
        $first = join(', ', array_slice($options, 0, -1));
        $both  = array_filter(array_merge(array($first), $last), 'strlen');
        return join(' ' . $join_string . ' ', $both);
    }
}
