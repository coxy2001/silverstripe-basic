<footer class="footer">
    <div class="container">
        <%-- <div class="row">
            <div class="col-12">
                <ul>
                    <% loop $MenuSet('Social').MenuItems %>
                        <li>
                            <a href="$Link" class="$LinkingMode hide-external-link" target="_blank" rel="noopener"></a>
                        </li>
                    <% end_loop %>
                </ul>
            </div>
        </div> --%>

        <nav class="footer__nav">
            <% loop Menu(1) %>
                <a class="footer__link" href="$Link" title="$Title.XML">$MenuTitle.XML</a>
            <% end_loop %>
        </div>

        <p class="footer__copyright">$SiteConfig.CompanyName &copy; $Now.Year</p>
    </div>
</footer>
