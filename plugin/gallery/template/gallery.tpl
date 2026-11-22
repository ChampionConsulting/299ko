<section>
    <header>
        <div class="item-head">
            {{ htmlspecialchars_decode(runPlugin.getConfigVal("introduction")) }}

            {% if gallery.useCategories() %}
                <ul class="categories">
                    {% if count(gallery.listCategories(false)) > 0 %}
                        <li><button rel="category_all" href="javascript:">{{ Lang.gallery.display-all-categories }}</button></li>
                    {% endif %}
                    {% for k, v in gallery.listCategories(false) %}
                        <li><button rel="category_{{util.strToUrl(v)}}" href="javascript:"><i class="fa-regular fa-folder-open"></i>{{v}}</button></li>
                    {% endfor %}
                </ul>
            {% endif %}
        </div>
    </header>
    {% if gallery.countItems() == false %}
        <p>{{Lang.gallery.no-item-found}}</p>
    {% else %}
        <ul id="list">
            {% for k, obj in gallery.getItems() %}
                {% if obj.getHidden() == false %}
                    <li class="category_{{ util.strToUrl(obj.getCategory()) }} category_all" style="background-image:url({{ obj.getUrl}});">
                        <a href="{{ obj.getUrl}}" data-fancybox="gallery" data-caption="{{ obj.getTitle}}<br>{{obj.getCategory}}<br>{{ obj.getContent() }}">
                            {% if runPlugin.getConfigVal("showTitles") %}
                                <span>{{ obj.getTitle}}</span>
                            {% endif %}
                        </a>
                    </li>
                {% endif %}
            {% endfor %}
    {% endif %}
</section>