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
        if (preg_match('/ies$/', $text)) {
            return substr($text, 0, -3) . 'y';
        } elseif (preg_match('/es$/', $text)) {
            return substr($text, 0, -2);
        } else if (preg_match('/s$/', $text)) {
            return substr($text, 0, -1);
        }
        
        return $text;
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
     * Convierte una palabra en formato de clase
     * @param string $text
     * @return string
     */
    public static function classify($text) {
        return preg_replace('/ /', '', ucwords(preg_replace('/_/', ' ', $text)));
    }
}
