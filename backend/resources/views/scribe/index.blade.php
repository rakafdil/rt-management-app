<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.10.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.10.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                                <a href="#endpoints-GETapi-user">GET api/user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-penghuni">
                                <a href="#endpoints-GETapi-v1-penghuni">GET api/v1/penghuni</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-penghuni">
                                <a href="#endpoints-POSTapi-v1-penghuni">POST api/v1/penghuni</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-penghuni--id-">
                                <a href="#endpoints-GETapi-v1-penghuni--id-">GET api/v1/penghuni/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-penghuni--id-">
                                <a href="#endpoints-PUTapi-v1-penghuni--id-">PUT api/v1/penghuni/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-penghuni--id-">
                                <a href="#endpoints-DELETEapi-v1-penghuni--id-">DELETE api/v1/penghuni/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-rumah">
                                <a href="#endpoints-GETapi-v1-rumah">GET api/v1/rumah</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-rumah">
                                <a href="#endpoints-POSTapi-v1-rumah">POST api/v1/rumah</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-rumah--id-">
                                <a href="#endpoints-GETapi-v1-rumah--id-">GET api/v1/rumah/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-rumah--id-">
                                <a href="#endpoints-PUTapi-v1-rumah--id-">PUT api/v1/rumah/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-rumah--id-">
                                <a href="#endpoints-DELETEapi-v1-rumah--id-">DELETE api/v1/rumah/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-rumah--rumah_id--histori">
                                <a href="#endpoints-GETapi-v1-rumah--rumah_id--histori">GET api/v1/rumah/{rumah_id}/histori</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-rumah--rumah_id--assign">
                                <a href="#endpoints-POSTapi-v1-rumah--rumah_id--assign">POST api/v1/rumah/{rumah_id}/assign</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-rumah--rumah_id--unassign">
                                <a href="#endpoints-POSTapi-v1-rumah--rumah_id--unassign">POST api/v1/rumah/{rumah_id}/unassign</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-rumah--rumah_id--tagihan">
                                <a href="#endpoints-GETapi-v1-rumah--rumah_id--tagihan">GET api/v1/rumah/{rumah_id}/tagihan</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-tagihan">
                                <a href="#endpoints-GETapi-v1-tagihan">GET api/v1/tagihan</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-tagihan">
                                <a href="#endpoints-POSTapi-v1-tagihan">POST api/v1/tagihan</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-tagihan--id-">
                                <a href="#endpoints-GETapi-v1-tagihan--id-">GET api/v1/tagihan/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-tagihan--id-">
                                <a href="#endpoints-PUTapi-v1-tagihan--id-">PUT api/v1/tagihan/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-tagihan--id-">
                                <a href="#endpoints-DELETEapi-v1-tagihan--id-">DELETE api/v1/tagihan/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-tagihan-generate-manual">
                                <a href="#endpoints-POSTapi-v1-tagihan-generate-manual">POST api/v1/tagihan/generate-manual</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-pembayaran">
                                <a href="#endpoints-GETapi-v1-pembayaran">GET api/v1/pembayaran</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-pembayaran">
                                <a href="#endpoints-POSTapi-v1-pembayaran">POST api/v1/pembayaran</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-pembayaran--id-">
                                <a href="#endpoints-GETapi-v1-pembayaran--id-">GET api/v1/pembayaran/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-pengeluaran">
                                <a href="#endpoints-GETapi-v1-pengeluaran">GET api/v1/pengeluaran</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-pengeluaran">
                                <a href="#endpoints-POSTapi-v1-pengeluaran">POST api/v1/pengeluaran</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-pengeluaran--id-">
                                <a href="#endpoints-GETapi-v1-pengeluaran--id-">GET api/v1/pengeluaran/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-pengeluaran--id-">
                                <a href="#endpoints-PUTapi-v1-pengeluaran--id-">PUT api/v1/pengeluaran/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-pengeluaran--id-">
                                <a href="#endpoints-DELETEapi-v1-pengeluaran--id-">DELETE api/v1/pengeluaran/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-reports-summary">
                                <a href="#endpoints-GETapi-v1-reports-summary">GET api/v1/reports/summary</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-reports-detail">
                                <a href="#endpoints-GETapi-v1-reports-detail">GET api/v1/reports/detail</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: May 30, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-user">GET api/user</h2>

<p>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-penghuni">GET api/v1/penghuni</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-penghuni">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/penghuni" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/penghuni"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-penghuni">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 7,
            &quot;nama_lengkap&quot;: &quot;adfasdf&quot;,
            &quot;foto_ktp_url&quot;: null,
            &quot;status_penghuni&quot;: &quot;tetap&quot;,
            &quot;nomor_telepon&quot;: null,
            &quot;status_menikah&quot;: false,
            &quot;status_menikah_label&quot;: &quot;Belum Menikah&quot;,
            &quot;bergabung_sejak&quot;: &quot;29 May 2026&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;nama_lengkap&quot;: &quot;M. Raka&quot;,
            &quot;foto_ktp_url&quot;: &quot;http://localhost:8000/storage/foto_ktp/ggmhWvZzXPhOVCenDWEvSEx2drhl46Rh7SEtmfUk.jpg&quot;,
            &quot;status_penghuni&quot;: &quot;kontrak&quot;,
            &quot;nomor_telepon&quot;: &quot;3232123&quot;,
            &quot;status_menikah&quot;: false,
            &quot;status_menikah_label&quot;: &quot;Belum Menikah&quot;,
            &quot;bergabung_sejak&quot;: &quot;29 May 2026&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;nama_lengkap&quot;: &quot;Raka Fadillah&quot;,
            &quot;foto_ktp_url&quot;: &quot;http://localhost:8000/storage/foto_ktp/gMBM4fYWFy9xdgWGaT5Agz6PvfS2h4RoSkGJIGrf.png&quot;,
            &quot;status_penghuni&quot;: &quot;tetap&quot;,
            &quot;nomor_telepon&quot;: &quot;123123123&quot;,
            &quot;status_menikah&quot;: true,
            &quot;status_menikah_label&quot;: &quot;Menikah&quot;,
            &quot;bergabung_sejak&quot;: &quot;29 May 2026&quot;
        },
        {
            &quot;id&quot;: 1,
            &quot;nama_lengkap&quot;: &quot;Raka&quot;,
            &quot;foto_ktp_url&quot;: &quot;http://localhost:8000/storage/foto_ktp/ffkiRZ9ukdH8Pw5frP2fXnXZBqOnDFe8bEBJZl9G.png&quot;,
            &quot;status_penghuni&quot;: &quot;tetap&quot;,
            &quot;nomor_telepon&quot;: &quot;085336678947&quot;,
            &quot;status_menikah&quot;: false,
            &quot;status_menikah_label&quot;: &quot;Belum Menikah&quot;,
            &quot;bergabung_sejak&quot;: &quot;29 May 2026&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-penghuni" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-penghuni"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-penghuni"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-penghuni" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-penghuni">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-penghuni" data-method="GET"
      data-path="api/v1/penghuni"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-penghuni', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-penghuni"
                    onclick="tryItOut('GETapi-v1-penghuni');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-penghuni"
                    onclick="cancelTryOut('GETapi-v1-penghuni');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-penghuni"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/penghuni</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-penghuni"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-penghuni"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-penghuni">POST api/v1/penghuni</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-penghuni">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/penghuni" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "nomor_telepon=bngzmiyvdljnikhw"\
    --form "nama_lengkap=a"\
    --form "status_penghuni=kontrak"\
    --form "status_menikah="\
    --form "foto_ktp=@C:\Users\Asus\AppData\Local\Temp\php51CE.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/penghuni"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('nomor_telepon', 'bngzmiyvdljnikhw');
body.append('nama_lengkap', 'a');
body.append('status_penghuni', 'kontrak');
body.append('status_menikah', '');
body.append('foto_ktp', document.querySelector('input[name="foto_ktp"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-penghuni">
</span>
<span id="execution-results-POSTapi-v1-penghuni" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-penghuni"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-penghuni"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-penghuni" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-penghuni">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-penghuni" data-method="POST"
      data-path="api/v1/penghuni"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-penghuni', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-penghuni"
                    onclick="tryItOut('POSTapi-v1-penghuni');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-penghuni"
                    onclick="cancelTryOut('POSTapi-v1-penghuni');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-penghuni"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/penghuni</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-penghuni"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-penghuni"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>foto_ktp</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="foto_ktp"                data-endpoint="POSTapi-v1-penghuni"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Asus\AppData\Local\Temp\php51CE.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nomor_telepon</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nomor_telepon"                data-endpoint="POSTapi-v1-penghuni"
               value="bngzmiyvdljnikhw"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>bngzmiyvdljnikhw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nama_lengkap</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nama_lengkap"                data-endpoint="POSTapi-v1-penghuni"
               value="a"
               data-component="body">
    <br>
<p>Must not be greater than 150 characters. Example: <code>a</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status_penghuni</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status_penghuni"                data-endpoint="POSTapi-v1-penghuni"
               value="kontrak"
               data-component="body">
    <br>
<p>Example: <code>kontrak</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>tetap</code></li> <li><code>kontrak</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status_menikah</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-penghuni" style="display: none">
            <input type="radio" name="status_menikah"
                   value="true"
                   data-endpoint="POSTapi-v1-penghuni"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-penghuni" style="display: none">
            <input type="radio" name="status_menikah"
                   value="false"
                   data-endpoint="POSTapi-v1-penghuni"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-penghuni--id-">GET api/v1/penghuni/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-penghuni--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/penghuni/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/penghuni/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-penghuni--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;nama_lengkap&quot;: &quot;Raka&quot;,
        &quot;foto_ktp_url&quot;: &quot;http://localhost:8000/storage/foto_ktp/ffkiRZ9ukdH8Pw5frP2fXnXZBqOnDFe8bEBJZl9G.png&quot;,
        &quot;status_penghuni&quot;: &quot;tetap&quot;,
        &quot;nomor_telepon&quot;: &quot;085336678947&quot;,
        &quot;status_menikah&quot;: false,
        &quot;status_menikah_label&quot;: &quot;Belum Menikah&quot;,
        &quot;bergabung_sejak&quot;: &quot;29 May 2026&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-penghuni--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-penghuni--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-penghuni--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-penghuni--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-penghuni--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-penghuni--id-" data-method="GET"
      data-path="api/v1/penghuni/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-penghuni--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-penghuni--id-"
                    onclick="tryItOut('GETapi-v1-penghuni--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-penghuni--id-"
                    onclick="cancelTryOut('GETapi-v1-penghuni--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-penghuni--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/penghuni/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-penghuni--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-penghuni--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-penghuni--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the penghuni. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-penghuni--id-">PUT api/v1/penghuni/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-penghuni--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/penghuni/1" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "nomor_telepon=bngzmiyvdljnikhw"\
    --form "nama_lengkap=a"\
    --form "status_penghuni=kontrak"\
    --form "status_menikah="\
    --form "foto_ktp=@C:\Users\Asus\AppData\Local\Temp\php520D.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/penghuni/1"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('nomor_telepon', 'bngzmiyvdljnikhw');
body.append('nama_lengkap', 'a');
body.append('status_penghuni', 'kontrak');
body.append('status_menikah', '');
body.append('foto_ktp', document.querySelector('input[name="foto_ktp"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-penghuni--id-">
</span>
<span id="execution-results-PUTapi-v1-penghuni--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-penghuni--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-penghuni--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-penghuni--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-penghuni--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-penghuni--id-" data-method="PUT"
      data-path="api/v1/penghuni/{id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-penghuni--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-penghuni--id-"
                    onclick="tryItOut('PUTapi-v1-penghuni--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-penghuni--id-"
                    onclick="cancelTryOut('PUTapi-v1-penghuni--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-penghuni--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/penghuni/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/penghuni/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-penghuni--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-penghuni--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-penghuni--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the penghuni. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>foto_ktp</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="foto_ktp"                data-endpoint="PUTapi-v1-penghuni--id-"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Asus\AppData\Local\Temp\php520D.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nomor_telepon</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nomor_telepon"                data-endpoint="PUTapi-v1-penghuni--id-"
               value="bngzmiyvdljnikhw"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>bngzmiyvdljnikhw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nama_lengkap</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nama_lengkap"                data-endpoint="PUTapi-v1-penghuni--id-"
               value="a"
               data-component="body">
    <br>
<p>Must not be greater than 150 characters. Example: <code>a</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status_penghuni</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status_penghuni"                data-endpoint="PUTapi-v1-penghuni--id-"
               value="kontrak"
               data-component="body">
    <br>
<p>Example: <code>kontrak</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>tetap</code></li> <li><code>kontrak</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status_menikah</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-penghuni--id-" style="display: none">
            <input type="radio" name="status_menikah"
                   value="true"
                   data-endpoint="PUTapi-v1-penghuni--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-penghuni--id-" style="display: none">
            <input type="radio" name="status_menikah"
                   value="false"
                   data-endpoint="PUTapi-v1-penghuni--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-penghuni--id-">DELETE api/v1/penghuni/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-penghuni--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/penghuni/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/penghuni/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-penghuni--id-">
</span>
<span id="execution-results-DELETEapi-v1-penghuni--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-penghuni--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-penghuni--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-penghuni--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-penghuni--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-penghuni--id-" data-method="DELETE"
      data-path="api/v1/penghuni/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-penghuni--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-penghuni--id-"
                    onclick="tryItOut('DELETEapi-v1-penghuni--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-penghuni--id-"
                    onclick="cancelTryOut('DELETEapi-v1-penghuni--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-penghuni--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/penghuni/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-penghuni--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-penghuni--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-penghuni--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the penghuni. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-rumah">GET api/v1/rumah</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-rumah">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/rumah" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/rumah"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-rumah">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;blok_nomor&quot;: &quot;abc&quot;,
            &quot;status_huni&quot;: &quot;dihuni&quot;,
            &quot;penghuni_aktif&quot;: {
                &quot;id&quot;: 7,
                &quot;nama_lengkap&quot;: &quot;adfasdf&quot;,
                &quot;nomor_telepon&quot;: null
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;blok_nomor&quot;: &quot;halo&quot;,
            &quot;status_huni&quot;: &quot;dihuni&quot;,
            &quot;penghuni_aktif&quot;: {
                &quot;id&quot;: 3,
                &quot;nama_lengkap&quot;: &quot;M. Raka&quot;,
                &quot;nomor_telepon&quot;: &quot;3232123&quot;
            }
        },
        {
            &quot;id&quot;: 1,
            &quot;blok_nomor&quot;: &quot;woiii&quot;,
            &quot;status_huni&quot;: &quot;dihuni&quot;,
            &quot;penghuni_aktif&quot;: {
                &quot;id&quot;: 2,
                &quot;nama_lengkap&quot;: &quot;Raka Fadillah&quot;,
                &quot;nomor_telepon&quot;: &quot;123123123&quot;
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-rumah" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-rumah"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-rumah"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-rumah" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-rumah">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-rumah" data-method="GET"
      data-path="api/v1/rumah"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-rumah', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-rumah"
                    onclick="tryItOut('GETapi-v1-rumah');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-rumah"
                    onclick="cancelTryOut('GETapi-v1-rumah');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-rumah"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/rumah</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-rumah"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-rumah"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-rumah">POST api/v1/rumah</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-rumah">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/rumah" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"blok_nomor\": \"b\",
    \"penghuni_id\": \"architecto\",
    \"tanggal_mulai\": \"2026-05-30T11:53:46\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/rumah"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "blok_nomor": "b",
    "penghuni_id": "architecto",
    "tanggal_mulai": "2026-05-30T11:53:46"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-rumah">
</span>
<span id="execution-results-POSTapi-v1-rumah" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-rumah"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-rumah"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-rumah" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-rumah">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-rumah" data-method="POST"
      data-path="api/v1/rumah"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-rumah', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-rumah"
                    onclick="tryItOut('POSTapi-v1-rumah');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-rumah"
                    onclick="cancelTryOut('POSTapi-v1-rumah');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-rumah"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/rumah</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-rumah"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-rumah"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blok_nomor</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="blok_nomor"                data-endpoint="POSTapi-v1-rumah"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>penghuni_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="penghuni_id"                data-endpoint="POSTapi-v1-rumah"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tanggal_mulai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tanggal_mulai"                data-endpoint="POSTapi-v1-rumah"
               value="2026-05-30T11:53:46"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-05-30T11:53:46</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-rumah--id-">GET api/v1/rumah/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-rumah--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/rumah/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/rumah/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-rumah--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;blok_nomor&quot;: &quot;woiii&quot;,
        &quot;status_huni&quot;: &quot;dihuni&quot;,
        &quot;penghuni_aktif&quot;: {
            &quot;id&quot;: 2,
            &quot;nama_lengkap&quot;: &quot;Raka Fadillah&quot;
        },
        &quot;histori_huni&quot;: [
            {
                &quot;id&quot;: 10,
                &quot;nama_lengkap&quot;: &quot;Raka&quot;,
                &quot;tanggal_mulai&quot;: &quot;30 May 2026&quot;,
                &quot;tanggal_selesai&quot;: &quot;30 May 2026&quot;
            },
            {
                &quot;id&quot;: 12,
                &quot;nama_lengkap&quot;: &quot;Raka&quot;,
                &quot;tanggal_mulai&quot;: &quot;30 May 2026&quot;,
                &quot;tanggal_selesai&quot;: &quot;30 May 2026&quot;
            },
            {
                &quot;id&quot;: 13,
                &quot;nama_lengkap&quot;: &quot;Raka Fadillah&quot;,
                &quot;tanggal_mulai&quot;: &quot;30 May 2026&quot;,
                &quot;tanggal_selesai&quot;: &quot;Sekarang (Masih Aktif)&quot;
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-rumah--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-rumah--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-rumah--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-rumah--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-rumah--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-rumah--id-" data-method="GET"
      data-path="api/v1/rumah/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-rumah--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-rumah--id-"
                    onclick="tryItOut('GETapi-v1-rumah--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-rumah--id-"
                    onclick="cancelTryOut('GETapi-v1-rumah--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-rumah--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/rumah/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-rumah--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-rumah--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-rumah--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the rumah. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-rumah--id-">PUT api/v1/rumah/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-rumah--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/rumah/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"blok_nomor\": \"b\",
    \"penghuni_id\": \"architecto\",
    \"tanggal_mulai\": \"2026-05-30T11:53:46\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/rumah/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "blok_nomor": "b",
    "penghuni_id": "architecto",
    "tanggal_mulai": "2026-05-30T11:53:46"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-rumah--id-">
</span>
<span id="execution-results-PUTapi-v1-rumah--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-rumah--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-rumah--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-rumah--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-rumah--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-rumah--id-" data-method="PUT"
      data-path="api/v1/rumah/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-rumah--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-rumah--id-"
                    onclick="tryItOut('PUTapi-v1-rumah--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-rumah--id-"
                    onclick="cancelTryOut('PUTapi-v1-rumah--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-rumah--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/rumah/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/rumah/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-rumah--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-rumah--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-rumah--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the rumah. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blok_nomor</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="blok_nomor"                data-endpoint="PUTapi-v1-rumah--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>penghuni_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="penghuni_id"                data-endpoint="PUTapi-v1-rumah--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tanggal_mulai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tanggal_mulai"                data-endpoint="PUTapi-v1-rumah--id-"
               value="2026-05-30T11:53:46"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-05-30T11:53:46</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-rumah--id-">DELETE api/v1/rumah/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-rumah--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/rumah/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/rumah/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-rumah--id-">
</span>
<span id="execution-results-DELETEapi-v1-rumah--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-rumah--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-rumah--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-rumah--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-rumah--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-rumah--id-" data-method="DELETE"
      data-path="api/v1/rumah/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-rumah--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-rumah--id-"
                    onclick="tryItOut('DELETEapi-v1-rumah--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-rumah--id-"
                    onclick="cancelTryOut('DELETEapi-v1-rumah--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-rumah--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/rumah/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-rumah--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-rumah--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-rumah--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the rumah. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-rumah--rumah_id--histori">GET api/v1/rumah/{rumah_id}/histori</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-rumah--rumah_id--histori">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/rumah/1/histori" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/rumah/1/histori"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-rumah--rumah_id--histori">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 10,
            &quot;penghuni_id&quot;: 1,
            &quot;rumah_id&quot;: 1,
            &quot;tanggal_mulai&quot;: &quot;2026-05-30T00:00:00.000000Z&quot;,
            &quot;tanggal_selesai&quot;: &quot;2026-05-30T00:00:00.000000Z&quot;,
            &quot;created_at&quot;: &quot;2026-05-30T06:27:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-05-30T06:27:46.000000Z&quot;,
            &quot;penghuni&quot;: {
                &quot;id&quot;: 1,
                &quot;nama_lengkap&quot;: &quot;Raka&quot;,
                &quot;foto_ktp&quot;: &quot;foto_ktp/ffkiRZ9ukdH8Pw5frP2fXnXZBqOnDFe8bEBJZl9G.png&quot;,
                &quot;status_penghuni&quot;: &quot;tetap&quot;,
                &quot;nomor_telepon&quot;: &quot;085336678947&quot;,
                &quot;status_menikah&quot;: false,
                &quot;created_at&quot;: &quot;2026-05-29T11:07:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-05-29T13:08:46.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 12,
            &quot;penghuni_id&quot;: 1,
            &quot;rumah_id&quot;: 1,
            &quot;tanggal_mulai&quot;: &quot;2026-05-30T00:00:00.000000Z&quot;,
            &quot;tanggal_selesai&quot;: &quot;2026-05-30T00:00:00.000000Z&quot;,
            &quot;created_at&quot;: &quot;2026-05-30T06:28:07.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-05-30T06:34:48.000000Z&quot;,
            &quot;penghuni&quot;: {
                &quot;id&quot;: 1,
                &quot;nama_lengkap&quot;: &quot;Raka&quot;,
                &quot;foto_ktp&quot;: &quot;foto_ktp/ffkiRZ9ukdH8Pw5frP2fXnXZBqOnDFe8bEBJZl9G.png&quot;,
                &quot;status_penghuni&quot;: &quot;tetap&quot;,
                &quot;nomor_telepon&quot;: &quot;085336678947&quot;,
                &quot;status_menikah&quot;: false,
                &quot;created_at&quot;: &quot;2026-05-29T11:07:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-05-29T13:08:46.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 13,
            &quot;penghuni_id&quot;: 2,
            &quot;rumah_id&quot;: 1,
            &quot;tanggal_mulai&quot;: &quot;2026-05-30T00:00:00.000000Z&quot;,
            &quot;tanggal_selesai&quot;: null,
            &quot;created_at&quot;: &quot;2026-05-30T06:40:36.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-05-30T06:40:36.000000Z&quot;,
            &quot;penghuni&quot;: {
                &quot;id&quot;: 2,
                &quot;nama_lengkap&quot;: &quot;Raka Fadillah&quot;,
                &quot;foto_ktp&quot;: &quot;foto_ktp/gMBM4fYWFy9xdgWGaT5Agz6PvfS2h4RoSkGJIGrf.png&quot;,
                &quot;status_penghuni&quot;: &quot;tetap&quot;,
                &quot;nomor_telepon&quot;: &quot;123123123&quot;,
                &quot;status_menikah&quot;: true,
                &quot;created_at&quot;: &quot;2026-05-29T13:19:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-05-29T13:19:32.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-rumah--rumah_id--histori" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-rumah--rumah_id--histori"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-rumah--rumah_id--histori"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-rumah--rumah_id--histori" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-rumah--rumah_id--histori">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-rumah--rumah_id--histori" data-method="GET"
      data-path="api/v1/rumah/{rumah_id}/histori"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-rumah--rumah_id--histori', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-rumah--rumah_id--histori"
                    onclick="tryItOut('GETapi-v1-rumah--rumah_id--histori');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-rumah--rumah_id--histori"
                    onclick="cancelTryOut('GETapi-v1-rumah--rumah_id--histori');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-rumah--rumah_id--histori"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/rumah/{rumah_id}/histori</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-rumah--rumah_id--histori"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-rumah--rumah_id--histori"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>rumah_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rumah_id"                data-endpoint="GETapi-v1-rumah--rumah_id--histori"
               value="1"
               data-component="url">
    <br>
<p>The ID of the rumah. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-rumah--rumah_id--assign">POST api/v1/rumah/{rumah_id}/assign</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-rumah--rumah_id--assign">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/rumah/1/assign" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"penghuni_id\": \"architecto\",
    \"tanggal_mulai\": \"2026-05-30T11:53:46\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/rumah/1/assign"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "penghuni_id": "architecto",
    "tanggal_mulai": "2026-05-30T11:53:46"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-rumah--rumah_id--assign">
</span>
<span id="execution-results-POSTapi-v1-rumah--rumah_id--assign" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-rumah--rumah_id--assign"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-rumah--rumah_id--assign"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-rumah--rumah_id--assign" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-rumah--rumah_id--assign">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-rumah--rumah_id--assign" data-method="POST"
      data-path="api/v1/rumah/{rumah_id}/assign"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-rumah--rumah_id--assign', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-rumah--rumah_id--assign"
                    onclick="tryItOut('POSTapi-v1-rumah--rumah_id--assign');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-rumah--rumah_id--assign"
                    onclick="cancelTryOut('POSTapi-v1-rumah--rumah_id--assign');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-rumah--rumah_id--assign"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/rumah/{rumah_id}/assign</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-rumah--rumah_id--assign"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-rumah--rumah_id--assign"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>rumah_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rumah_id"                data-endpoint="POSTapi-v1-rumah--rumah_id--assign"
               value="1"
               data-component="url">
    <br>
<p>The ID of the rumah. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>penghuni_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="penghuni_id"                data-endpoint="POSTapi-v1-rumah--rumah_id--assign"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the penghuni table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tanggal_mulai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tanggal_mulai"                data-endpoint="POSTapi-v1-rumah--rumah_id--assign"
               value="2026-05-30T11:53:46"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-05-30T11:53:46</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-rumah--rumah_id--unassign">POST api/v1/rumah/{rumah_id}/unassign</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-rumah--rumah_id--unassign">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/rumah/1/unassign" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tanggal_selesai\": \"2026-05-30T11:53:46\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/rumah/1/unassign"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tanggal_selesai": "2026-05-30T11:53:46"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-rumah--rumah_id--unassign">
</span>
<span id="execution-results-POSTapi-v1-rumah--rumah_id--unassign" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-rumah--rumah_id--unassign"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-rumah--rumah_id--unassign"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-rumah--rumah_id--unassign" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-rumah--rumah_id--unassign">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-rumah--rumah_id--unassign" data-method="POST"
      data-path="api/v1/rumah/{rumah_id}/unassign"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-rumah--rumah_id--unassign', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-rumah--rumah_id--unassign"
                    onclick="tryItOut('POSTapi-v1-rumah--rumah_id--unassign');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-rumah--rumah_id--unassign"
                    onclick="cancelTryOut('POSTapi-v1-rumah--rumah_id--unassign');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-rumah--rumah_id--unassign"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/rumah/{rumah_id}/unassign</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-rumah--rumah_id--unassign"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-rumah--rumah_id--unassign"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>rumah_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rumah_id"                data-endpoint="POSTapi-v1-rumah--rumah_id--unassign"
               value="1"
               data-component="url">
    <br>
<p>The ID of the rumah. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tanggal_selesai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tanggal_selesai"                data-endpoint="POSTapi-v1-rumah--rumah_id--unassign"
               value="2026-05-30T11:53:46"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-05-30T11:53:46</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-rumah--rumah_id--tagihan">GET api/v1/rumah/{rumah_id}/tagihan</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-rumah--rumah_id--tagihan">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/rumah/1/tagihan" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/rumah/1/tagihan"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-rumah--rumah_id--tagihan">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;100000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 1,
                &quot;nama_iuran&quot;: &quot;Iuran Satpam&quot;
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;15000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 2,
                &quot;nama_iuran&quot;: &quot;Iuran Kebersihan&quot;
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;30000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 3,
                &quot;nama_iuran&quot;: &quot;Iuran Kas RT&quot;
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;25000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 4,
                &quot;nama_iuran&quot;: &quot;Iuran Kegiatan Pemuda&quot;
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-rumah--rumah_id--tagihan" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-rumah--rumah_id--tagihan"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-rumah--rumah_id--tagihan"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-rumah--rumah_id--tagihan" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-rumah--rumah_id--tagihan">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-rumah--rumah_id--tagihan" data-method="GET"
      data-path="api/v1/rumah/{rumah_id}/tagihan"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-rumah--rumah_id--tagihan', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-rumah--rumah_id--tagihan"
                    onclick="tryItOut('GETapi-v1-rumah--rumah_id--tagihan');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-rumah--rumah_id--tagihan"
                    onclick="cancelTryOut('GETapi-v1-rumah--rumah_id--tagihan');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-rumah--rumah_id--tagihan"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/rumah/{rumah_id}/tagihan</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-rumah--rumah_id--tagihan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-rumah--rumah_id--tagihan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>rumah_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rumah_id"                data-endpoint="GETapi-v1-rumah--rumah_id--tagihan"
               value="1"
               data-component="url">
    <br>
<p>The ID of the rumah. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-tagihan">GET api/v1/tagihan</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-tagihan">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/tagihan" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tagihan"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-tagihan">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;100000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 1,
                &quot;nama_iuran&quot;: &quot;Iuran Satpam&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 1,
                &quot;blok_nomor&quot;: &quot;woiii&quot;
            }
        },
        {
            &quot;id&quot;: 11,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;30000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 3,
                &quot;nama_iuran&quot;: &quot;Iuran Kas RT&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 3,
                &quot;blok_nomor&quot;: &quot;halo&quot;
            }
        },
        {
            &quot;id&quot;: 10,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;15000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 2,
                &quot;nama_iuran&quot;: &quot;Iuran Kebersihan&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 3,
                &quot;blok_nomor&quot;: &quot;halo&quot;
            }
        },
        {
            &quot;id&quot;: 9,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;100000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 1,
                &quot;nama_iuran&quot;: &quot;Iuran Satpam&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 3,
                &quot;blok_nomor&quot;: &quot;halo&quot;
            }
        },
        {
            &quot;id&quot;: 8,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;25000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 4,
                &quot;nama_iuran&quot;: &quot;Iuran Kegiatan Pemuda&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 2,
                &quot;blok_nomor&quot;: &quot;abc&quot;
            }
        },
        {
            &quot;id&quot;: 7,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;30000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 3,
                &quot;nama_iuran&quot;: &quot;Iuran Kas RT&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 2,
                &quot;blok_nomor&quot;: &quot;abc&quot;
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;15000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 2,
                &quot;nama_iuran&quot;: &quot;Iuran Kebersihan&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 2,
                &quot;blok_nomor&quot;: &quot;abc&quot;
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;100000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 1,
                &quot;nama_iuran&quot;: &quot;Iuran Satpam&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 2,
                &quot;blok_nomor&quot;: &quot;abc&quot;
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;25000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 4,
                &quot;nama_iuran&quot;: &quot;Iuran Kegiatan Pemuda&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 1,
                &quot;blok_nomor&quot;: &quot;woiii&quot;
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;30000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 3,
                &quot;nama_iuran&quot;: &quot;Iuran Kas RT&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 1,
                &quot;blok_nomor&quot;: &quot;woiii&quot;
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;15000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 2,
                &quot;nama_iuran&quot;: &quot;Iuran Kebersihan&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 1,
                &quot;blok_nomor&quot;: &quot;woiii&quot;
            }
        },
        {
            &quot;id&quot;: 12,
            &quot;periode&quot;: &quot;February 2001&quot;,
            &quot;periode_bulan&quot;: 2,
            &quot;periode_tahun&quot;: 2001,
            &quot;nominal_tagihan&quot;: &quot;25000.00&quot;,
            &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
            &quot;jenis_iuran&quot;: {
                &quot;id&quot;: 4,
                &quot;nama_iuran&quot;: &quot;Iuran Kegiatan Pemuda&quot;
            },
            &quot;rumah&quot;: {
                &quot;id&quot;: 3,
                &quot;blok_nomor&quot;: &quot;halo&quot;
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-tagihan" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-tagihan"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-tagihan"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-tagihan" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-tagihan">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-tagihan" data-method="GET"
      data-path="api/v1/tagihan"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-tagihan', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-tagihan"
                    onclick="tryItOut('GETapi-v1-tagihan');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-tagihan"
                    onclick="cancelTryOut('GETapi-v1-tagihan');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-tagihan"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/tagihan</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-tagihan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-tagihan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-tagihan">POST api/v1/tagihan</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-tagihan">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/tagihan" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rumah_id\": \"architecto\",
    \"jenis_iuran_id\": \"architecto\",
    \"periode_bulan\": 2,
    \"periode_tahun\": 1539,
    \"nominal_tagihan\": 66
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tagihan"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rumah_id": "architecto",
    "jenis_iuran_id": "architecto",
    "periode_bulan": 2,
    "periode_tahun": 1539,
    "nominal_tagihan": 66
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-tagihan">
</span>
<span id="execution-results-POSTapi-v1-tagihan" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-tagihan"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-tagihan"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-tagihan" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-tagihan">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-tagihan" data-method="POST"
      data-path="api/v1/tagihan"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-tagihan', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-tagihan"
                    onclick="tryItOut('POSTapi-v1-tagihan');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-tagihan"
                    onclick="cancelTryOut('POSTapi-v1-tagihan');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-tagihan"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/tagihan</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-tagihan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-tagihan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rumah_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="rumah_id"                data-endpoint="POSTapi-v1-tagihan"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the rumah table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>jenis_iuran_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="jenis_iuran_id"                data-endpoint="POSTapi-v1-tagihan"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the jenis_iuran table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>periode_bulan</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="periode_bulan"                data-endpoint="POSTapi-v1-tagihan"
               value="2"
               data-component="body">
    <br>
<p>Must be between 1 and 12. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>periode_tahun</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="periode_tahun"                data-endpoint="POSTapi-v1-tagihan"
               value="1539"
               data-component="body">
    <br>
<p>Must be at least 2000. Example: <code>1539</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nominal_tagihan</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nominal_tagihan"                data-endpoint="POSTapi-v1-tagihan"
               value="66"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>66</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-tagihan--id-">GET api/v1/tagihan/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-tagihan--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/tagihan/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tagihan/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-tagihan--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;periode&quot;: &quot;February 2001&quot;,
        &quot;periode_bulan&quot;: 2,
        &quot;periode_tahun&quot;: 2001,
        &quot;nominal_tagihan&quot;: &quot;100000.00&quot;,
        &quot;status_pembayaran&quot;: &quot;belum_bayar&quot;,
        &quot;jenis_iuran&quot;: {
            &quot;id&quot;: 1,
            &quot;nama_iuran&quot;: &quot;Iuran Satpam&quot;
        },
        &quot;rumah&quot;: {
            &quot;id&quot;: 1,
            &quot;blok_nomor&quot;: &quot;woiii&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-tagihan--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-tagihan--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-tagihan--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-tagihan--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-tagihan--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-tagihan--id-" data-method="GET"
      data-path="api/v1/tagihan/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-tagihan--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-tagihan--id-"
                    onclick="tryItOut('GETapi-v1-tagihan--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-tagihan--id-"
                    onclick="cancelTryOut('GETapi-v1-tagihan--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-tagihan--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/tagihan/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-tagihan--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-tagihan--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-tagihan--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the tagihan. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-tagihan--id-">PUT api/v1/tagihan/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-tagihan--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/tagihan/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rumah_id\": \"architecto\",
    \"nominal_tagihan\": 22,
    \"status_pembayaran\": \"sebagian\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tagihan/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rumah_id": "architecto",
    "nominal_tagihan": 22,
    "status_pembayaran": "sebagian"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-tagihan--id-">
</span>
<span id="execution-results-PUTapi-v1-tagihan--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-tagihan--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-tagihan--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-tagihan--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-tagihan--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-tagihan--id-" data-method="PUT"
      data-path="api/v1/tagihan/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-tagihan--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-tagihan--id-"
                    onclick="tryItOut('PUTapi-v1-tagihan--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-tagihan--id-"
                    onclick="cancelTryOut('PUTapi-v1-tagihan--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-tagihan--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/tagihan/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/tagihan/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-tagihan--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-tagihan--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-tagihan--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the tagihan. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rumah_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="rumah_id"                data-endpoint="PUTapi-v1-tagihan--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the rumah table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nominal_tagihan</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nominal_tagihan"                data-endpoint="PUTapi-v1-tagihan--id-"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status_pembayaran</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status_pembayaran"                data-endpoint="PUTapi-v1-tagihan--id-"
               value="sebagian"
               data-component="body">
    <br>
<p>Example: <code>sebagian</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>belum_bayar</code></li> <li><code>sebagian</code></li> <li><code>lunas</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-tagihan--id-">DELETE api/v1/tagihan/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-tagihan--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/tagihan/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tagihan/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-tagihan--id-">
</span>
<span id="execution-results-DELETEapi-v1-tagihan--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-tagihan--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-tagihan--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-tagihan--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-tagihan--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-tagihan--id-" data-method="DELETE"
      data-path="api/v1/tagihan/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-tagihan--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-tagihan--id-"
                    onclick="tryItOut('DELETEapi-v1-tagihan--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-tagihan--id-"
                    onclick="cancelTryOut('DELETEapi-v1-tagihan--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-tagihan--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/tagihan/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-tagihan--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-tagihan--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-tagihan--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the tagihan. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-tagihan-generate-manual">POST api/v1/tagihan/generate-manual</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-tagihan-generate-manual">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/tagihan/generate-manual" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"bulan\": 2,
    \"tahun\": 1494
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/tagihan/generate-manual"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "bulan": 2,
    "tahun": 1494
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-tagihan-generate-manual">
</span>
<span id="execution-results-POSTapi-v1-tagihan-generate-manual" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-tagihan-generate-manual"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-tagihan-generate-manual"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-tagihan-generate-manual" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-tagihan-generate-manual">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-tagihan-generate-manual" data-method="POST"
      data-path="api/v1/tagihan/generate-manual"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-tagihan-generate-manual', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-tagihan-generate-manual"
                    onclick="tryItOut('POSTapi-v1-tagihan-generate-manual');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-tagihan-generate-manual"
                    onclick="cancelTryOut('POSTapi-v1-tagihan-generate-manual');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-tagihan-generate-manual"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/tagihan/generate-manual</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-tagihan-generate-manual"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-tagihan-generate-manual"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bulan</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bulan"                data-endpoint="POSTapi-v1-tagihan-generate-manual"
               value="2"
               data-component="body">
    <br>
<p>Must be between 1 and 12. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tahun</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tahun"                data-endpoint="POSTapi-v1-tagihan-generate-manual"
               value="1494"
               data-component="body">
    <br>
<p>Must be at least 2000. Example: <code>1494</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-pembayaran">GET api/v1/pembayaran</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-pembayaran">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/pembayaran" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/pembayaran"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-pembayaran">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-pembayaran" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-pembayaran"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-pembayaran"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-pembayaran" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-pembayaran">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-pembayaran" data-method="GET"
      data-path="api/v1/pembayaran"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-pembayaran', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-pembayaran"
                    onclick="tryItOut('GETapi-v1-pembayaran');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-pembayaran"
                    onclick="cancelTryOut('GETapi-v1-pembayaran');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-pembayaran"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/pembayaran</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-pembayaran"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-pembayaran"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-pembayaran">POST api/v1/pembayaran</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-pembayaran">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/pembayaran" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rumah_id\": \"architecto\",
    \"tanggal_bayar\": \"2026-05-30T11:53:47\",
    \"total_bayar\": 22,
    \"metode_pembayaran\": \"g\",
    \"catatan\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/pembayaran"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rumah_id": "architecto",
    "tanggal_bayar": "2026-05-30T11:53:47",
    "total_bayar": 22,
    "metode_pembayaran": "g",
    "catatan": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-pembayaran">
</span>
<span id="execution-results-POSTapi-v1-pembayaran" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-pembayaran"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-pembayaran"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-pembayaran" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-pembayaran">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-pembayaran" data-method="POST"
      data-path="api/v1/pembayaran"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-pembayaran', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-pembayaran"
                    onclick="tryItOut('POSTapi-v1-pembayaran');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-pembayaran"
                    onclick="cancelTryOut('POSTapi-v1-pembayaran');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-pembayaran"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/pembayaran</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-pembayaran"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-pembayaran"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rumah_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="rumah_id"                data-endpoint="POSTapi-v1-pembayaran"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the rumah table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>penghuni_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="penghuni_id"                data-endpoint="POSTapi-v1-pembayaran"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the penghuni table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tanggal_bayar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tanggal_bayar"                data-endpoint="POSTapi-v1-pembayaran"
               value="2026-05-30T11:53:47"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-05-30T11:53:47</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>total_bayar</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="total_bayar"                data-endpoint="POSTapi-v1-pembayaran"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>metode_pembayaran</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="metode_pembayaran"                data-endpoint="POSTapi-v1-pembayaran"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>g</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>catatan</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="catatan"                data-endpoint="POSTapi-v1-pembayaran"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tagihan_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tagihan_ids[0]"                data-endpoint="POSTapi-v1-pembayaran"
               data-component="body">
        <input type="text" style="display: none"
               name="tagihan_ids[1]"                data-endpoint="POSTapi-v1-pembayaran"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the tagihan table.</p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-pembayaran--id-">GET api/v1/pembayaran/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-pembayaran--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/pembayaran/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/pembayaran/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-pembayaran--id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Pembayaran] 16&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-pembayaran--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-pembayaran--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-pembayaran--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-pembayaran--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-pembayaran--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-pembayaran--id-" data-method="GET"
      data-path="api/v1/pembayaran/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-pembayaran--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-pembayaran--id-"
                    onclick="tryItOut('GETapi-v1-pembayaran--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-pembayaran--id-"
                    onclick="cancelTryOut('GETapi-v1-pembayaran--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-pembayaran--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/pembayaran/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-pembayaran--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-pembayaran--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-pembayaran--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the pembayaran. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-pengeluaran">GET api/v1/pengeluaran</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-pengeluaran">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/pengeluaran" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/pengeluaran"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-pengeluaran">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-pengeluaran" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-pengeluaran"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-pengeluaran"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-pengeluaran" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-pengeluaran">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-pengeluaran" data-method="GET"
      data-path="api/v1/pengeluaran"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-pengeluaran', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-pengeluaran"
                    onclick="tryItOut('GETapi-v1-pengeluaran');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-pengeluaran"
                    onclick="cancelTryOut('GETapi-v1-pengeluaran');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-pengeluaran"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/pengeluaran</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-pengeluaran"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-pengeluaran"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-pengeluaran">POST api/v1/pengeluaran</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-pengeluaran">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/pengeluaran" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"deskripsi\": \"architecto\",
    \"nominal\": 22,
    \"tanggal_pengeluaran\": \"2026-05-30T11:53:47\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/pengeluaran"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "deskripsi": "architecto",
    "nominal": 22,
    "tanggal_pengeluaran": "2026-05-30T11:53:47"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-pengeluaran">
</span>
<span id="execution-results-POSTapi-v1-pengeluaran" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-pengeluaran"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-pengeluaran"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-pengeluaran" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-pengeluaran">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-pengeluaran" data-method="POST"
      data-path="api/v1/pengeluaran"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-pengeluaran', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-pengeluaran"
                    onclick="tryItOut('POSTapi-v1-pengeluaran');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-pengeluaran"
                    onclick="cancelTryOut('POSTapi-v1-pengeluaran');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-pengeluaran"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/pengeluaran</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-pengeluaran"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-pengeluaran"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>kategori_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="kategori_id"                data-endpoint="POSTapi-v1-pengeluaran"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the kategori_pengeluaran table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deskripsi</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="deskripsi"                data-endpoint="POSTapi-v1-pengeluaran"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nominal</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nominal"                data-endpoint="POSTapi-v1-pengeluaran"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tanggal_pengeluaran</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tanggal_pengeluaran"                data-endpoint="POSTapi-v1-pengeluaran"
               value="2026-05-30T11:53:47"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-05-30T11:53:47</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-pengeluaran--id-">GET api/v1/pengeluaran/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-pengeluaran--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/pengeluaran/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/pengeluaran/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-pengeluaran--id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Pengeluaran] 16&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-pengeluaran--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-pengeluaran--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-pengeluaran--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-pengeluaran--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-pengeluaran--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-pengeluaran--id-" data-method="GET"
      data-path="api/v1/pengeluaran/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-pengeluaran--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-pengeluaran--id-"
                    onclick="tryItOut('GETapi-v1-pengeluaran--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-pengeluaran--id-"
                    onclick="cancelTryOut('GETapi-v1-pengeluaran--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-pengeluaran--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/pengeluaran/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-pengeluaran--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-pengeluaran--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-pengeluaran--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the pengeluaran. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-pengeluaran--id-">PUT api/v1/pengeluaran/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-pengeluaran--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/pengeluaran/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"deskripsi\": \"architecto\",
    \"nominal\": 22,
    \"tanggal_pengeluaran\": \"2026-05-30T11:53:47\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/pengeluaran/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "deskripsi": "architecto",
    "nominal": 22,
    "tanggal_pengeluaran": "2026-05-30T11:53:47"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-pengeluaran--id-">
</span>
<span id="execution-results-PUTapi-v1-pengeluaran--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-pengeluaran--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-pengeluaran--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-pengeluaran--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-pengeluaran--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-pengeluaran--id-" data-method="PUT"
      data-path="api/v1/pengeluaran/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-pengeluaran--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-pengeluaran--id-"
                    onclick="tryItOut('PUTapi-v1-pengeluaran--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-pengeluaran--id-"
                    onclick="cancelTryOut('PUTapi-v1-pengeluaran--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-pengeluaran--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/pengeluaran/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/pengeluaran/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-pengeluaran--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-pengeluaran--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-pengeluaran--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the pengeluaran. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>kategori_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="kategori_id"                data-endpoint="PUTapi-v1-pengeluaran--id-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the kategori_pengeluaran table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deskripsi</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="deskripsi"                data-endpoint="PUTapi-v1-pengeluaran--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nominal</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nominal"                data-endpoint="PUTapi-v1-pengeluaran--id-"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tanggal_pengeluaran</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tanggal_pengeluaran"                data-endpoint="PUTapi-v1-pengeluaran--id-"
               value="2026-05-30T11:53:47"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-05-30T11:53:47</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-pengeluaran--id-">DELETE api/v1/pengeluaran/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-pengeluaran--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/pengeluaran/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/pengeluaran/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-pengeluaran--id-">
</span>
<span id="execution-results-DELETEapi-v1-pengeluaran--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-pengeluaran--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-pengeluaran--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-pengeluaran--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-pengeluaran--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-pengeluaran--id-" data-method="DELETE"
      data-path="api/v1/pengeluaran/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-pengeluaran--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-pengeluaran--id-"
                    onclick="tryItOut('DELETEapi-v1-pengeluaran--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-pengeluaran--id-"
                    onclick="cancelTryOut('DELETEapi-v1-pengeluaran--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-pengeluaran--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/pengeluaran/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-pengeluaran--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-pengeluaran--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-pengeluaran--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the pengeluaran. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-reports-summary">GET api/v1/reports/summary</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-reports-summary">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/reports/summary" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/reports/summary"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-reports-summary">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Berhasil mengambil summary laporan keuangan tahun 2026&quot;,
    &quot;data&quot;: {
        &quot;tahun&quot;: 2026,
        &quot;total_pemasukan&quot;: 0,
        &quot;total_pengeluaran&quot;: 0,
        &quot;saldo_sisa_saat_ini&quot;: 0,
        &quot;grafik&quot;: [
            {
                &quot;bulan&quot;: 1,
                &quot;nama_bulan&quot;: &quot;Jan&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 2,
                &quot;nama_bulan&quot;: &quot;Feb&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 3,
                &quot;nama_bulan&quot;: &quot;Mar&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 4,
                &quot;nama_bulan&quot;: &quot;Apr&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 5,
                &quot;nama_bulan&quot;: &quot;May&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 6,
                &quot;nama_bulan&quot;: &quot;Jun&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 7,
                &quot;nama_bulan&quot;: &quot;Jul&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 8,
                &quot;nama_bulan&quot;: &quot;Aug&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 9,
                &quot;nama_bulan&quot;: &quot;Sep&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 10,
                &quot;nama_bulan&quot;: &quot;Oct&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 11,
                &quot;nama_bulan&quot;: &quot;Nov&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            },
            {
                &quot;bulan&quot;: 12,
                &quot;nama_bulan&quot;: &quot;Dec&quot;,
                &quot;pemasukan&quot;: 0,
                &quot;pengeluaran&quot;: 0,
                &quot;saldo_akhir&quot;: 0
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-reports-summary" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-reports-summary"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-reports-summary"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-reports-summary" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-reports-summary">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-reports-summary" data-method="GET"
      data-path="api/v1/reports/summary"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-reports-summary', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-reports-summary"
                    onclick="tryItOut('GETapi-v1-reports-summary');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-reports-summary"
                    onclick="cancelTryOut('GETapi-v1-reports-summary');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-reports-summary"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/reports/summary</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-reports-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-reports-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tahun</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tahun"                data-endpoint="GETapi-v1-reports-summary"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-reports-detail">GET api/v1/reports/detail</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-reports-detail">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/reports/detail" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/reports/detail"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-reports-detail">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-reports-detail" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-reports-detail"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-reports-detail"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-reports-detail" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-reports-detail">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-reports-detail" data-method="GET"
      data-path="api/v1/reports/detail"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-reports-detail', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-reports-detail"
                    onclick="tryItOut('GETapi-v1-reports-detail');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-reports-detail"
                    onclick="cancelTryOut('GETapi-v1-reports-detail');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-reports-detail"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/reports/detail</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-reports-detail"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-reports-detail"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
