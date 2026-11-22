<!DOCTYPE html>
<html lang="{{ lang.getLocale}}">
	<head>
        {% HOOK.frontHead %}
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{{ SHOW.titleTag }}</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=5" />
        <meta name="description" content="{{ SHOW.metaDescriptionTag }}" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" type="text/css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/4.0.31/fancybox.min.css" rel="stylesheet" type="text/css" />
		
		<link type="text/css" rel="stylesheet" href="{{ SHOW.siteUrl }}/theme/minimal/styles.css" media="screen,projection"/> 
		<link rel="icon" href="{{ SHOW.themeIcon }}"/>
        {{ SHOW.linkTags }}
		{{ SHOW.scriptTags }}
		{{ SHOW.showMetas }}
		{% HOOK.endFrontHead %}
</head>
<body>
<div id="mobile_menu"></div>
<div id="container">
	<div id="header">
		<div id="header_content">
			<button id="mobile_menu" aria-label="Menu"></button>
			<p id="siteName"><a href="{{ SHOW.siteUrl }}">{{ SHOW.siteName }}</a></p>
			<ul id="navigation">
				{{ SHOW.mainNavigation }}
				{% HOOK.endMainNavigation %}                
			</ul>
		</div>
	</div>
	<div id="body">
		<div id="content" class="{{ SHOW.pluginId }}">
			{{ SHOW.mainTitle }} 
		</div>
	    <div id="content" class="{{ SHOW.pluginId }}">
         {{ CONTENT }}
    </div>
</div>
<div id="footer">
	<div id="footer_content">
			{% HOOK.footer %}
				<p>		<a target='_blank' href='https://github.com/ChampionConsulting/'>{{ Lang.site-just-using( ) }}</a>
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
			<a href='https://cms.championconsulting.com/' class='madewithchampion-badge' style='left: 24px!important;right: auto!important; bottom: 32px!important;'><img src='{{ SHOW.siteUrl }}/theme/endless/created.gif'></a>
			{% HOOK.endFooter %}
		</div>
	</div>
</div>
        {% HOOK.endFrontBody %}
</body>
</html>