<div id="$Name" class="field<% if $extraClass %> $extraClass<% end_if %>">
    <% if $Title %><p class="left">$Title</p><% end_if %>
    <% loop $FieldList %>
        $Field
    <% end_loop %>
    <% if $RightTitle %><span id="{$Name}_right_title" class="right-title">$RightTitle</span><% end_if %>
    <% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
</div>
