<% if $UseButtonTag %>
    <button $getAttributesHTML("class") class="btn <% if $getAttribute("type") == "submit" %>btn--success<% else %>btn--secondary<% end_if %> $extraClass">
        <% if $ButtonContent %>$ButtonContent<% else %><span>$Title.XML</span><% end_if %>
    </button>
<% else %>
    <input $getAttributesHTML("class") class="btn <% if $getAttribute("type") == "submit" %>btn--success<% else %>btn--secondary<% end_if %> $extraClass" />
<% end_if %>