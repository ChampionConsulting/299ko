<section>
	{% if page.isUnlocked(pageItem) %}
		{% if pluginsManager.isActivePlugin("gallery") && gallery.searchByFileName(pageItem.getImg) %}
			<header>
				<img class="featured" src="{{ pageItem.getImgUrl }}" alt="{{ pageItem.getName }}"/>
			</header>
		{% endif %}
		{{ htmlspecialchars_decode(pageItem.getContent) }}
	{% else %}
		<header>
			<div class="item-head">
				<p>This page is password protected.</p>
			</div>
		</header>
		<form method="post" action="">
			<input type="hidden" name="unlock" value="{{ sendUrl }}"/>
			<p>
				<label>Enter Password</label><br>
				<input style="display:none;" type="text" name="_password" value=""/>
				<input required="required" type="password" name="password" value=""/>
			</p>
			<p>
				<input type="submit" value="Send"/>
			</p>
		</form>
	{% endif %}
</section>
