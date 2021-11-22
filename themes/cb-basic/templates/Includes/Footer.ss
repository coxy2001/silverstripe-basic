<footer>
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

        <div class="row">
            <div class="col-12">
                <ul class="nav mb-3 justify-content-center flex-column flex-md-row">
                    <% loop Menu(1) %>
                        <li class="nav-item $LinkingMode">
                            <a class="nav-link" href="$Link" title="$Title.XML">$MenuTitle.XML</a>
                        </li>
                    <% end_loop %>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
              <p class="copyright">$SiteConfig.CompanyName &copy; $Now.Year</p>
            </div>
        </div>
      </div>
    </div>
</footer>
