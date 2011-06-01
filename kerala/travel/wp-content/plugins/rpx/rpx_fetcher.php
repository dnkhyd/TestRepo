<?php
/*
Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if(!class_exists('Services_JSON')) {
  require_once('JSON.php');
}

function rpx_has_curl() {
  return function_exists('curl_init');
}


function rpx_http_post($url, $post_data) {
  if (rpx_has_curl()) {
    return rpx_curl_http_post($url, $post_data);
  } else {
    return rpx_builtin_http_post($url, $post_data);
  }
}

function rpx_curl_http_post($url, $post_data) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $raw_data = curl_exec($curl);
  curl_close($curl);
  return $raw_data;
}


function rpx_builtin_http_post($url, $post_data) {
  $content = http_build_query($post_data);
  $opts = array('http'=>array('method'=>"POST", 'content'=>$content));
  $context = stream_context_create($opts);
  $raw_data = file_get_contents($url, 0, $context);
  return $raw_data;
}


/* parsing stuff */

function rpx_get_json_coder() {
  return new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
}

function rpx_parse_auth_info($raw) {
  $json = rpx_get_json_coder();
  return $json->decode($raw);
}

function rpx_parse_lookup_rp($raw) {
  $json = rpx_get_json_coder();
  return $json->decode($raw);
}

?>