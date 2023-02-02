<?php

function extract_video_id($url, $hostname) {
    if ($hostname === 'drive.google.com') {
        $parts = parse_url($url);
        parse_str($parts['path'], $query);
        $id = $query['id'];
        return $id;
    } elseif ($hostname === 'fembed.com') {
        $parts = parse_url($url);
        $id = explode('/', $parts['path'])[2];
        return $id;
    } elseif ($hostname === 'sibnet.ru') {
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        $id = $query['videoid'];
        return $id;
    } elseif ($hostname === 'dailymotion.com') {
        $parts = explode('/', parse_url($url)['path']);
        return end($parts);
    } elseif ($hostname === 'youtube.com') {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        if(isset($query['v']))
          return $query['v'];
        else
          return null;
    } elseif ($hostname === 'cloudvideo.tv') {
        $parts = parse_url($url);
        $id = explode('/', $parts['path'])[2];
        return $id;
    }
    return null;
}
function convert_url_to_embed($url) {
    $hostname = parse_url($url, PHP_URL_HOST);
    $video_id = extract_video_id($url, $hostname);
    $platforms = [
        'drive.google.com' => 'https://drive.google.com/file/d/' . $video_id . '/preview',
        'fembed.com' => 'https://www.fembed.com/v/' . $video_id,
        'sibnet.ru' => 'https://video.sibnet.ru/shell.php?videoid=' . $video_id,
        'dailymotion.com' => 'https://www.dailymotion.com/video/' . $video_id,
        'youtube.com' => 'https://www.youtube.com/watch?v=' . $video_id,
        'cloudvideo.tv' => 'https://www.cloudvideo.tv/embed/' . $video_id,
    ];
    if(array_key_exists($hostname,$platforms))
    {
        return $platforms[$hostname];
    }
    else 
    { 
    	return 'not work';	
    }
}
