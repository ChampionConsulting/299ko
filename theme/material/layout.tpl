<!DOCTYPE html>
<html lang="{{ lang.getLocale}}">
	<head>
		{% HOOK.frontHead %}
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>{{ SHOW.titleTag }}</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=5"/>
		<meta name="description" content="{{ SHOW.metaDescriptionTag }}"/>
		<link rel="icon" href="{{ SHOW.themeIcon }}"/>
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
        <link type="text/css" rel="stylesheet" href="{{ SHOW.siteUrl }}/theme/material/css/materialize.min.css"  media="screen,projection"/>
        {{ SHOW.linkTags }}
		{{ SHOW.scriptTags }}
		{{ SHOW.showMetas }}
		{% HOOK.endFrontHead %}
     <!-- <script type="text/javascript" src="{{ SHOW.siteUrl }}/theme/material/js/materialize.min.js"></script>-->
	</head>
    <body>     
		<div id="container">
			<div id="header">
				<nav id="header_content">
					<button id="mobile_menu" aria-label="{{ Lang.site-menu-label }}"></button>
					<p id="siteName">
						<a href="{{ SHOW.siteUrl }}">{{ SHOW.siteName }}</a>
					</p>
					<ul id="navigation">
						{{ SHOW.mainNavigation }}
						{% HOOK.endMainNavigation %}
					</ul>
				</nav>
			</div>
			<div id="alert-msg">
				{{ SHOW.displayMsg }}
			</div>
			<div id="banner">
				<div id="siteDesc">
					{{ SHOW.siteDesc}}
				</div>
			</div>
        <div id="body" class='card container'>
			<div id="content" class="{{ SHOW.pluginId }}">
						{{ CONTENT }} 						
	</div>
</div>
<footer id="footer" class="page-footer">
    <div id="footer_content" class="container">
       {% HOOK.footer %}
    </div>
			<p>			<a target='_blank' href='https://github.com/ChampionConsulting/299ko'>{{ Lang.site-just-using( ) }}</a>
						-
						{{ Lang.site-theme }}
						{{ SHOW.theme }}
						-
						{% if IS_LOGGED %}
							<a rel="nofollow" href="{{ ROUTER.generate("logout") }}">{{ Lang.core-disconnection }}</a>
							{% if IS_ADMIN %}
								-
								<a rel="nofollow" href="{{ ROUTER.generate("admin") }}">{{ Lang.site-admin }}</a>
							{% endif %}
						{% else %}
							<a rel="nofollow" href="{{ ROUTER.generate("login") }}">{{ Lang.core-connection }}</a>
						{% endif %}
						</p>						
	<!-- Made by Daedalus -->	
	<a href='https://cms.championconsulting.com/' class='madewithchampion-badge' style='left: 24px!important;right: auto!important; bottom: 32px!important;'><img src='{{ SHOW.siteUrl }}/theme/material/created.gif'></a>
      {% HOOK.endFooter %}
   </div>
</footer> 
{% HOOK.endFrontBody %}
</body>
</html>