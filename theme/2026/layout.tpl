<!DOCTYPE html>
<html lang="{{ lang.getLocale}}">
	<head>
        {% HOOK.frontHead %}
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{{ SHOW.titleTag }}</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=5" />
        <meta name="description" content="{{ SHOW.metaDescriptionTag }}" />
        <link type="text/css" rel="stylesheet" href="{{ SHOW.siteUrl }}/theme/2026/styles.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="{{ SHOW.siteUrl }}/theme/2026/index.DXZNJHJl.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="{{ SHOW.siteUrl }}/theme/2026/dist/accordion.min.css"  media="screen,projection"/>  		
		<link rel="icon" href="{{ SHOW.themeIcon }}" />
        {{ SHOW.linkTags }}
		{{ SHOW.scriptTags }}
		{{ SHOW.showMetas }}
		{% HOOK.endFrontHead %}        
    <script type="text/javascript" src="{{ SHOW.siteUrl }}/theme/2026/scripts.js" /></script>
	
	</head>
    <body>
		<div id="container">
            <div id="header">
                <div id="top_header_container">                    
				<div id="logo">
				<a id="{{ SHOW.siteName }}" href="{{ SHOW.siteUrl }}">
				<img src="{{ SHOW.siteUrl }}/theme/2026/logo.png" alt="{{ SHOW.siteName }}" title="{{ SHOW.siteName }}"/></a>
                </div>
                <div id="navigation_container">
                    <ul id="navigation">
                        {{ SHOW.mainNavigation }}
                        {% HOOK.endMainNavigation %}
                    </ul>
                </div>
            </div>
        </div>
    </div>
            <div id="alert-msg">
                {{ SHOW.displayMsg }}
            </div>
            <div id="banner"></div>
            <main id="body">
                {% IF CORE.getConfigVal(hideTitles) == 0 %}
                    <div id="pageTitle">
                    {{ SHOW.mainTitle }}
                </div>
                {% ENDIF %}
                <div id="body-page">
                    <div id="content" class="{{ SHOW.pluginId }}">
                        {{ CONTENT }}
                    </div>
                    {{ show.displayPublicSidebar() }}
                </div>
            </main>
            <div id="footer">
                <div id="footer_content">
					{% HOOK.footer %}
					<p>
						<a target='_blank' href='https://github.com/ChampionConsulting/299ko'>{{ Lang.site-just-using( ) }}</a>
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
					<a href='https://cms.championconsulting.com/' class='madewithchampion-badge' style='left: 24px!important;right: auto!important; bottom: 32px!important;'><img src='{{ SHOW.siteUrl }}/theme/2026/created.gif'></a>
                    {% HOOK.endFooter %}
                </div>
            </div>
        </div>
        {% HOOK.endFrontBody %}
			<script type="text/javascript" src="{{ SHOW.siteUrl }}/theme/2026/dist/accordion.min.js" /></script>
	
    <script>
      new Accordion(".accordion-container");
    </script>
    </body>

</html>
