<?php

class dl_youtube_com extends Download
{

    public function FreeLeech($url)
    {
        $url = preg_replace('/https?:\/\/(www.)?/i', 'http://www.', $url);
        $parse = parse_url($url);
        $video_id = explode("v=", $parse['query']);
        $video_id = $video_id[1];
        if (stristr($video_id, "&")) {
            $video_id = explode("&", $video_id);
            $video_id = $video_id[0];
        }
 $response=Array();
        $data = $this->lib->curl("https://www.googleapis.com/youtube/v3/videos?id=".$video_id."&key=AIzaSyBDnF2cHmKd1gj143mcnHCYUwfhQ3YTiss&part=snippet", "", "", 0);
        //$verial=file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$video_id."&key=AIzaSyBDnF2cHmKd1gj143mcnHCYUwfhQ3YTiss&part=snippet");

           $response=json_decode($data,true);
        $this->lib->reserved['filename'] = str_replace(str_split('\\:*?"<>|=;'."\t\r\n\f"), '_', html_entity_decode(trim($response["items"][0]['snippet']['title'].".mp4"), ENT_QUOTES));
          $dataFile = $this->lib->curl("https://youtubemp4.to/download_ajax/", "", "url={$url}",0,1);
   $jsons = json_decode($dataFile,true);
  $hamveri=$jsons["result"];
  preg_match('/href=["\']?([^"\'>]+)["\']?/', $hamveri, $match);
  $furl= $match[1];
 //echo var_dump($jsons);  
   
 $data = $this->lib->curl($furl, $this->lib->cookie, "");
            if ($this->isRedirect($data)) {
                return trim($this->redirect);
            }
             return false;
   //     return trim($furl);
        
    }

}

/*
 * Open Source Project
 * New Vinaget by LTT
 * Version: 3.3 LTS
 * Youtube.com Download Plugin By Enes BiBER
 * Date: 20.10.2019
 */
