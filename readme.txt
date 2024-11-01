=== WP Ajax Random Posts ===
Contributors: QiQiBoY
Author Homepage: http://www.qiqiboy.com
Tags: wordpress, ajax, random, rand, posts
Requires at least: 2.7
Tested up to: 3.0.1
Stable tag: 1.0.0

Show your Random posts on sidebar and provide ajax auto refresh function.

== Description ==
Show your random posts on sidebar and provide ajax refresh function.
How to use this plug-in? It's easy and you have two ways:<br>
1.Go to widgets page to add the widget to your sidebar.<br>
2.use the function <code>&lt;?php WP_Ajax_Random_Posts('number=8&cmtcount=1&excerpt=1&length=100&auto=0&time=60'); ?></code> to custom the posts display position.<br>
This function accepts six parameters:<br>
<code>number</code>: how many posts display. Type: Integer, default 8<br>
<code>cmtcount</code>: display comments count of the post. Type: Boolean, default 0. 1: yes, 0: no<br>
<code>excerpt</code>: display excerpt of no. Type: Boolean, default 0. 1: yes, 0: no<br>
<code>length</code>: the length of the excerpt. Type: Integer, default 100<br>
<code>auto</code>: auto refresh random psots list or not. Type: Boolean, default 0. 1: yes, 0: no<br>
<code>time</code>: the auto refresh interval(seconds). Type: Integer, default 60<br>
显示一组支持ajax自动刷新的随机文章列表。<br>
如何使用插件呢？很简单，有两种方法：<br>
1.到小工具页面去添加小工具。<br>
2.使用自定义调用函数<code>&lt;?php WP_Ajax_Random_Posts('number=8&cmtcount=1&excerpt=1&length=100&auto=0&time=60'); ?></code><br>

== Installation ==

1. Download the plugin archive and expand it (you've likely already done this).
2. Put the 'WP Ajax Random Posts' directory into your wp-content/plugins/ directory.
3. Go to the Plugins page in your WordPress Administration area and click 'Activate' for WP Ajax Random Posts.
4. Go to the WP Ajax Random Posts Options page (Settings > WP Ajax Random Posts Option).
5. Go to widgets page to add the widget to your sidebar.

下载插件，上传到插件目录，在后台管理中激活插件，到设置页面进行简单设置，然后在小工具页面向边栏添加ajax随机文章即可。<br>

== Changelog ==
= 1.0 =
2010/10/09
插件开发完毕，上线。