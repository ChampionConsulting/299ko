<!DOCTYPE html>
<html lang="{{ lang.getLocale}}">
	<head>
		{% HOOK.frontHead %}
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>{{ SHOW.titleTag }}</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=5"/>
		<meta name="description" content="{{ SHOW.metaDescriptionTag }}"/>
		<link rel="icon" href="{{ SHOW.themeIcon }}"/>
        {{ SHOW.linkTags }}
		{{ SHOW.scriptTags }}
		{{ SHOW.showMetas }}
		{% HOOK.endFrontHead %}
    </head>
<body>
<div id="mobile_menu"></div>
<div id="container">
	<div id="container_right"></div>
	<div id="container_left">
		<div id="header">
			<div id="header_content">
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
		<div id="body-page">
       <div id="content" class="{{ SHOW.pluginId }}">
                        {{ CONTENT }}
                  </div>
             </div>		
		</div> 
	</div>
<div id="footer">
	<div id="footer_content">
					{% HOOK.footer %}
					<p>
						<a target='_blank' href='https://github.com/ChampionConsulting/'>{{ Lang.site-just-using( ) }}</a>
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
	<a href='https://cms.championconsulting.com/' class='madewithchampion-badge' style='left: 24px!important;right: auto!important; bottom: 32px!important;'><img src='{{ SHOW.siteUrl }}/theme/left/created.gif'></a>
				{% HOOK.endFooter %}
			</div>
		</div>
	</div>
</div>
{% HOOK.endFrontBody %}
</body>
</html>