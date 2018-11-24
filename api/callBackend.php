<?php

define('base_url', '/api/callBackend.php');


# include limonade Framework
require_once('lib/limonade.php');

# matches GET /
dispatch('/', 'blog_posts_home');
  function blog_posts_home()
  {
    echo '<br>hello root';
  }

# matches GET /posts  
dispatch('/posts', 'blog_posts_index');
  function blog_posts_index()
  {
    echo '<br>all posts displayed';
  }

dispatch('/hello/:name', 'hello');
  function hello()
  {
      $name = params('name');
      echo 'Hello ' . $name;
  }

dispatch('/hello/:ID/chuj', 'helloChuj');
  function helloChuj()
  {
      $name = params('ID');
      echo 'Hello ' . $name . ' chuj';
  }

run();
?>