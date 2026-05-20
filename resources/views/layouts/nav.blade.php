            <nav class="navbar navbar-expand-lg p-0 py-2 m-0">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="collapse navbar-collapse links" id="navbarNav">
                    <ul class="navbar-nav fw-bold">
                        <a class="nav-link nav-black {{ request()->routeIs('home') ? 'active text-danger' : '' }}"
                            href="{{ route('home') }}">
                            HOME
                        </a>

                                                
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-black" href="#" id="dropdownMenuHelpdesk" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                HELPDESK
                            </a>
                            <ul class="dropdown-menu helpdesk-dropdown border-start-0 border-end-0 border-danger rounded-0 m-0" aria-labelledby="dropdownMenuHelpdesk">
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://helpdesk.olympus.com.ph:8081/">Helpdesk Online</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://mishelpdesk.olympus.com.ph:8081/helpdesk/WebObjects/Helpdesk.woa">MIS Helpdesk</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://hrmhelpdesk.olympus.com.ph:8085/">HRM Helpdesk</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link nav-black" href="#" id="dropdownMenuErp" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ERP
                            </a>
                            <ul class="dropdown-menu helpdesk-dropdown border-start-0 border-end-0 border-danger rounded-0 m-0" aria-labelledby="dropdownMenuErp">
                                <li class="helpdesk-box"><a class="dropdown-item" href="https://docs.oracle.com/cloud/latest/netsuitecs_gs/docs.html">NetSuite Manuals</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="https://system.na0.netsuite.com/pages/customerlogin.jsp">NetSuite</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="https://sea-olympus.odoo.com/web/login">Odoo</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link nav-black" href="#" id="dropdownMenuEmail" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                EMAIL
                            </a>
                            <ul class="dropdown-menu helpdesk-dropdown border-start-0 border-end-0 border-danger rounded-0 m-0" aria-labelledby="dropdownMenuEmail">
                                <li class="helpdesk-box"><a class="dropdown-item" href="https://witcher.mxrouting.net/roundcube/">olympus.com.ph - Webmail</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="https://outlook.office.com/mail/">seaolympus.com - Webmail</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="https://premium151.web-hosting.com:2096/">maisonbergerph.com - Webmail</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://somidirectory.olympus.omi/addressbook/view/index.php">SOMI DIRECTORY (Landline/Mobile)</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://somidirectory.olympus.omi/addbookvip/index.php">VIP DIRECTORY ( Mobile )</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="https://login.microsoftonline.com/common/oauth2/v2.0/authorize?response_type=id_token&amp;scope=openid%20profile&amp;client_id=5e3ce6c0-2b1f-4285-8d4b-75ee78787346&amp;redirect_uri=https%3A%2F%2Fteams.microsoft.com%2Fgo&amp;state=eyJpZCI6IjZmYWY2ZmI3LWU0ZWMtNGZkZi1hN2UwLWNjMzJlMDAxYjViYiIsInRzIjoxNjMzMDU4MzA1LCJtZXRob2QiOiJyZWRpcmVjdEludGVyYWN0aW9uIn0%3D&amp;nonce=9dd52d98-89d8-4cc5-8b94-82bf7f42d79a&amp;client_info=1&amp;x-client-SKU=MSAL.JS&amp;x-client-Ver=1.3.4&amp;client-request-id=c168e677-a4ed-4aa6-96ef-a57f0b12484c&amp;response_mode=fragment">Microsoft Teams Sign-In</a></li>
                            </ul>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link nav-black" href="#" id="dropdownMenuHris" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                HRIS
                            </a>
                            <ul class="dropdown-menu helpdesk-dropdown border-start-0 border-end-0 border-danger rounded-0 m-0" aria-labelledby="dropdownMenuHris">
                                <li class="helpdesk-box"><a class="dropdown-item" href="https://hris.aub.com.ph/hris/eportal/">Employee Portal</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://webapps.olympus.com.ph/webapps/uploads/simplex/teaser/Code%20of%20Conduct/NEW%20EMPLOYEE%20CODE%20OF%20CONDUCT_EFFECTIVE%20JAN%201%202020_reviewed%20and%20approved%20file.pdf">SOMI Code of Conduct</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://zkwebtime.olympus.omi:8043/accounts/login/?next=/data/index/">SOMI WebTime - Cebu</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://attendance.olympus.com.ph:5000">SOMI ATTENDANCE</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://mlazkteco.olympus.omi/accounts/login/?next=/data/index/">SOMI WebTime - Taguig</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://training.olympus.com.ph/moodle/login/index.php?loginredirect=1">SOMI Training Portal</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link nav-black" href="#" id="dropdownMenuPos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                POS
                            </a>
                            <ul class="dropdown-menu helpdesk-dropdown border-start-0 border-end-0 border-danger rounded-0 m-0" aria-labelledby="dropdownMenuPos">
                                <li class="dropdown dropend">
                                    <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        iPOS Luzon
                                    </a>
                                    <ul class="dropdown-menu dropleft border-start-0 border-end-0 border-danger rounded-0 ms-5 special-margin">
                                        <li><a class="dropdown-item" href="http://antipolo.innosoft.pos:89/">Antipolo Branch</a></li>
                                        <li><a class="dropdown-item" href="http://bacoor.innosoft.pos:82/">Bacoor Branch</a></li>
                                        <li><a class="dropdown-item" href="http://caloocan.innosoft.pos:83/">Caloocan Branch</a></li>
                                        <li><a class="dropdown-item" href="http://pampanga.innosoft.pos:90/">Pampanga Branch</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown dropend">
                                    <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        iPOS Visayas
                                    </a>
                                    <ul class="dropdown-menu dropleft border-start-0 border-end-0 border-danger rounded-0 ms-5 mt-2">
                                        <li><a class="dropdown-item" href="http://mandaue.innosoft.pos:100/">Mandaue Storefront Branch</a></li>
                                        <li><a class="dropdown-item" href="http://canduman.innosoft.pos:105/">Canduman Branch</a></li>
                                        <li><a class="dropdown-item" href="http://yati.innosoft.pos:106/">Yati Liloan Branch</a></li>
                                        <li><a class="dropdown-item" href="http://pardo.innosoft.pos:107/">Pardo Branch</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>

                            <li class="nav-item dropdown">
                            <a class="nav-link nav-black" href="#" id="dropdownMenuFm" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                FILE MANAGER
                            </a>
                            <ul class="dropdown-menu helpdesk-dropdown border-start-0 border-end-0 border-danger rounded-0 m-0" aria-labelledby="dropdownMenuFm">
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://mndfile.olympus.com.ph/">Mandaue File Server</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://mlafile.olympus.com.ph">Manila File Server</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://dvofile.olympus.com.ph:8080/cgi-bin/">Davao File Server</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://tydfile.olympus.com.ph:8080">Tayud File Server</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link nav-black" href="#" id="dropdownMenuKb" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                KNOWLEDGE BASE
                            </a>
                            <ul class="dropdown-menu helpdesk-dropdown border-start-0 border-end-0 border-danger rounded-0 m-0" aria-labelledby="dropdownMenuKb">
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://ebook.olympus.com.ph:2202/">Product Knowledge</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://mndfile.olympus.com.ph:8080/video">Product Knowledge </br> Videos Mandaue</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://mlafile.olympus.com.ph:8080/video">Product Knowledge </br> Videos Manila</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://dvofile.olympus.com.ph:8080/video/#gallery/Albums/cJinsP">Product Knowledge </br> Videos Davao</a></li>
                                <li class="helpdesk-box"><a class="dropdown-item" href="http://tydfile.olympus.com.ph:8080/video">Product Knowledge </br> Videos Tayud</a></li>
                            </ul>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>