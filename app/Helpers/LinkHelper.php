<?php

namespace App\Helpers;
use App\Models\Link;

class LinkHelper {
	const MAXIMUM_LINK_LENGTH = 65535;

	public static function longUrlHash($long_url) {
		// Set crc32 hash and long_url
        
        // Generate 32-bit unsigned integer crc32 value
        // Use sprintf to prevent compatibility issues with 32-bit systems
        // http://php.net/manual/en/function.crc32.php
        $crc32_hash = sprintf('%u', crc32($long_url));
        return $crc32_hash;
	}

	static public function longLinkExists($long_url, $user_id = false) {
        /**
         * Provided a long link (string),
         * check whether the link is in the DB.
         * If a username is provided, only search for links created by the
         * user.
         * @return boolean
         */
        $link_base = Link::longUrl($long_url);
        
        if($user_id)
        	$link_base->where('user_id', $user_id);
        
        $link = $link_base->first();

        if ($link == null) {
            return false;
        }
        else {
            return $link->short_url;
        }
    }

    static public function shortLinkExists($link_ending) {
        /**
         * Provided a link ending (string),
         * return the link object, or false.
         * @return Link model instance
         */

        $link = Link::where('short_url', $link_ending)->first();

        if ($link != null) {
            return $link;
        }
        else {
            return false;
        }
    }


    public static function formatLink($link_ending) {
        /**
        * Given a link ending and a boolean indicating whether a secret ending is needed,
        * return a link formatted with app protocol, app address, and link ending.
        * @param string $link_ending
        * @return string
        */
        $short_url = config('app.protocol') . config('app.address') . '/' . $link_ending;
        return $short_url;
    }

    public static function createShortLink($long_url) {
            
        if (strlen($long_url) > self::MAXIMUM_LINK_LENGTH) {
            // If $long_url is longer than the maximum length, then
            // throw an Exception
            throw new \Exception('Sorry, but your link is longer than the
                maximum length allowed.');
        }

        $existing_link = self::longLinkExists($long_url, request()->user_id);
        if($existing_link)
        	return self::formatLink($existing_link);

        $link_ending = self::findRandomEnding();

        return $link_ending;
    }

    static public function findRandomEnding() {
        /**
         * Return an available pseudorandom string of length PSEUDO_RANDOM_KEY_LENGTH,
         * as defined in .env
         * Edit PSEUDO_RANDOM_KEY_LENGTH in .env if you wish to increase the length
         * of the pseudorandom string generated.
         * @return string
         */

        $pr_str = '';
        $in_use = true;

        while ($in_use) {
            // Generate a new string until the ending is not in use
            $pr_str = str_random(env('PSEUDO_RANDOM_KEY_LENGTH'));
            $in_use = LinkHelper::shortLinkExists($pr_str);
        }

        return $pr_str;
    }

}