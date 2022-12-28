<div id="$Name" class="userform__field<% if $extraClass %> $extraClass<% end_if %>">
	<% if $Title %><label class="userform__label" for="$ID">$Title</label><% end_if %>
	<% if $RightTitle %><span id="{$Name}_right_title" class="userform__right-label">$RightTitle</span><% end_if %>
	$Field
	<% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
</div>