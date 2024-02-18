<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="robots" content="noindex" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Whoops!</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
        <style>
            :root {
                --main-bg-color: #fff;
                --main-text-color: #555;
                --dark-text-color: #222;
                --light-text-color: #c7c7c7;
                --brand-primary-color: #E06E3F;
                --light-bg-color: #ededee;
                --dark-bg-color: #404040;
            }
            body {
                height: 100%;
                background: var(--main-bg-color);
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
                color: var(--main-text-color);
                font-weight: 300;
                margin: 0;
                padding: 0;
            }
            h1 {
                font-weight: lighter;
                letter-spacing: 0.8;
                font-size: 3rem;
                color: var(--dark-text-color);
                margin: 0;
            }
            h1.headline {
                margin-top: 20%;
                font-size: 5rem;
            }
            .text-center {
                text-align: center;
            }
            p.lead {
                font-size: 1.6rem;
            }
            .container {
                max-width: 75rem;
                margin: 0 auto;
                padding: 1rem;
            }
            .header {
                background: var(--light-bg-color);
                color: var(--dark-text-color);
            }
            .header .container {
                padding: 1rem 1.75rem 1.75rem 1.75rem;
            }
            .header h1 {
                font-size: 2.5rem;
                font-weight: 500;
            }
            .header p {
                font-size: 1.2rem;
                margin: 0;
                line-height: 2.5;
            }
            .header a {
                color: var(--brand-primary-color);
                margin-left: 2rem;
                display: none;
                text-decoration: none;
            }
            .header:hover a {
                display: inline;
            }

            .footer {
                background: var(--dark-bg-color);
                color: var(--light-text-color);
            }
            .footer .container {
                border-top: 1px solid #e7e7e7;
                margin-top: 1rem;
                text-align: center;
            }
            .source {
                background: #343434;
                color: var(--light-text-color);
                padding: 0.5em 1em;
                border-radius: 5px;
                font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
                font-size: 0.85rem;
                margin: 0;
                overflow-x: scroll;
            }
            .source span.line {
                line-height: 1.4;
            }
            .source span.line .number {
                color: #666;
            }
            .source .line .highlight {
                display: block;
                background: var(--dark-text-color);
                color: var(--light-text-color);
            }
            .source span.highlight .number {
                color: #fff;
            }
            .tabs {
                list-style: none;
                list-style-position: inside;
                margin: 0;
                padding: 0;
                margin-bottom: -1px;
            }
            .tabs li {
                display: inline;
            }
            .tabs a:link,
            .tabs a:visited {
                padding: 0rem 1rem;
                line-height: 2.7;
                text-decoration: none;
                color: var(--dark-text-color);
                background: var(--light-bg-color);
                border: 1px solid rgba(0,0,0,0.15);
                border-bottom: 0;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                display: inline-block;
            }
            .tabs a:hover {
                background: var(--light-bg-color);
                border-color: rgba(0,0,0,0.15);
            }
            .tabs a.active {
                background: var(--main-bg-color);
                color: var(--main-text-color);
            }
            .tab-content {
                background: var(--main-bg-color);
                border: 1px solid rgba(0,0,0,0.15);
            }
            .content {
                padding: 1rem;
            }
            .hide {
                display: none;
            }
            .alert {
                margin-top: 2rem;
                display: block;
                text-align: center;
                line-height: 3.0;
                background: #d9edf7;
                border: 1px solid #bcdff1;
                border-radius: 5px;
                color: #31708f;
            }
            ul, ol {
                line-height: 1.8;
            }

            table {
                width: 100%;
                overflow: hidden;
            }
            th {
                text-align: left;
                border-bottom: 1px solid #e7e7e7;
                padding-bottom: 0.5rem;
            }
            td {
                padding: 0.2rem 0.5rem 0.2rem 0;
            }
            tr:hover td {
                background: #f1f1f1;
            }
            td pre {
                white-space: pre-wrap;
            }
            .trace a {
                color: inherit;
            }
            .trace table {
                width: auto;
            }
            .trace tr td:first-child {
                min-width: 5em;
                font-weight: bold;
            }
            .trace td {
                background: var(--light-bg-color);
                padding: 0 1rem;
            }
            .trace td pre {
                margin: 0;
            }
            .args {
                display: none;
            }
            div.logo {
                height: 200px;
                width: 155px;
                display: inline-block;
                opacity: 0.08;
                position: absolute;
                top: 2rem;
                left: 50%;
                margin-left: -73px;
            }
            body {
                height: 100%;
                background: #fafafa;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                color: #777;
                font-weight: 300;
            }
            h1 {
                font-weight: lighter;
                letter-spacing: normal;
                font-size: 3rem;
                margin-top: 0;
                margin-bottom: 0;
                color: #222;
            }
            .wrap {
                max-width: 1024px;
                margin: 5rem auto;
                padding: 2rem;
                background: #fff;
                text-align: center;
                border: 1px solid #efefef;
                border-radius: 0.5rem;
                position: relative;
            }
            pre {
                white-space: normal;
                margin-top: 1.5rem;
            }
            code {
                background: #fafafa;
                border: 1px solid #efefef;
                padding: 0.5rem 1rem;
                border-radius: 5px;
                display: block;
            }
            p {
                margin-top: 1.5rem;
            }
            .footer {
                margin-top: 2rem;
                border-top: 1px solid #efefef;
                padding: 1em 2em 0 2em;
                font-size: 85%;
                color: #999;
            }
            a:active,
            a:link,
            a:visited {
                color: #dd4814;
            }
        </style>
    </head>
    <body>
        <div class="wrap container text-center">
            <h1 class="headline">Whoops!</h1>
            <p class="lead">Sorry ! we are unable to process your request it seems to have hit a snag. Please try again later...</p>
            <a href="<?= base_url(); ?>" class="card w3-card btn w3-btn btn-info w3-red w3-hover-purple w3-text-white">Go Back</a>
        </div>
    </body>
</html>