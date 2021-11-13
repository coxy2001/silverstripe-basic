$ElementalArea

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3>Contact Information:</h3>
                <p class="ml-3">
                    <% if $SiteConfig.ContactEmail %>
                        Email Address: <a href="mailto:$SiteConfig.ContactEmail">$SiteConfig.ContactEmail</a>
                    <% end_if %>
                    <% if $SiteConfig.ContactPhone %>
                        <br>Phone Number: <a href="tel:$SiteConfig.ContactPhone">$SiteConfig.ContactPhone</a>
                    <% end_if %>
                    <% if $SiteConfig.ContactMobile %>
                        <br>Mobile Number: <a href="tel:$SiteConfig.ContactMobile">$SiteConfig.ContactMobile</a>
                    <% end_if %>
                    <% if $SiteConfig.ContactFax %>
                        <br>Fax: <a href="tel:$SiteConfig.ContactFax">$SiteConfig.ContactFax</a>
                    <% end_if %>
                </p>

                <% if $SiteConfig.CompanyAddress %>
                    <h3>Our Address:</h3>
                    <p class="ml-3">
                        $SiteConfig.getFullAddressFormatted()
                    </p>
                <% end_if %>
                
                <% if $SiteConfig.OpenHours %>
                    <h3>Open Hours:</h3>
                    <p class="ml-3">
                        $SiteConfig.OpenHours
                    </p>
                <% end_if %>
            </div>
            <div class="col-12 col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d10420.514467873722!2d174.07465621425953!3d-39.06005986874482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snz!4v1611469309042!5m2!1sen!2snz" 
                    width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</section>