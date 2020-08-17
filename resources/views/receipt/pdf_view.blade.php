<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt</title>
    <style>
        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* make sure to set some focus styles for accessibility */
        :focus {
            outline: 0;
        }

        /* HTML5 display-role reset for older browsers */
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        input[type=search]::-webkit-search-cancel-button,
        input[type=search]::-webkit-search-decoration,
        input[type=search]::-webkit-search-results-button,
        input[type=search]::-webkit-search-results-decoration {
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input[type=search] {
            -webkit-appearance: none;
            -moz-appearance: none;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }

        textarea {
            overflow: auto;
            vertical-align: top;
            resize: vertical;
        }

        /**
 * Correct `inline-block` display not defined in IE 6/7/8/9 and Firefox 3.
 */

        audio,
        canvas,
        video {
            display: inline-block;
            *display: inline;
            *zoom: 1;
            max-width: 100%;
        }

        /**
 * Prevent modern browsers from displaying `audio` without controls.
 * Remove excess height in iOS 5 devices.
 */

        audio:not([controls]) {
            display: none;
            height: 0;
        }

        /**
 * Address styling not present in IE 7/8/9, Firefox 3, and Safari 4.
 * Known issue: no IE 6 support.
 */

        [hidden] {
            display: none;
        }

        /**
 * 1. Correct text resizing oddly in IE 6/7 when body `font-size` is set using
 *    `em` units.
 * 2. Prevent iOS text size adjust after orientation change, without disabling
 *    user zoom.
 */

        html {
            font-size: 100%;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
            -ms-text-size-adjust: 100%;
            /* 2 */
        }

        /**
 * Address `outline` inconsistency between Chrome and other browsers.
 */

        a:focus {
            outline: thin dotted;
        }

        /**
 * Improve readability when focused and also mouse hovered in all browsers.
 */

        a:active,
        a:hover {
            outline: 0;
        }

        /**
 * 1. Remove border when inside `a` element in IE 6/7/8/9 and Firefox 3.
 * 2. Improve image quality when scaled in IE 7.
 */

        img {
            border: 0;
            /* 1 */
            -ms-interpolation-mode: bicubic;
            /* 2 */
        }

        /**
 * Address margin not present in IE 6/7/8/9, Safari 5, and Opera 11.
 */

        figure {
            margin: 0;
        }

        /**
 * Correct margin displayed oddly in IE 6/7.
 */

        form {
            margin: 0;
        }

        /**
 * Define consistent border, margin, and padding.
 */

        fieldset {
            border: 1px solid #c0c0c0;
            margin: 0 2px;
            padding: 0.35em 0.625em 0.75em;
        }

        /**
 * 1. Correct color not being inherited in IE 6/7/8/9.
 * 2. Correct text not wrapping in Firefox 3.
 * 3. Correct alignment displayed oddly in IE 6/7.
 */

        legend {
            border: 0;
            /* 1 */
            padding: 0;
            white-space: normal;
            /* 2 */
            *margin-left: -7px;
            /* 3 */
        }

        /**
 * 1. Correct font size not being inherited in all browsers.
 * 2. Address margins set differently in IE 6/7, Firefox 3+, Safari 5,
 *    and Chrome.
 * 3. Improve appearance and consistency in all browsers.
 */

        button,
        input,
        select,
        textarea {
            font-size: 100%;
            /* 1 */
            margin: 0;
            /* 2 */
            vertical-align: baseline;
            /* 3 */
            *vertical-align: middle;
            /* 3 */
        }

        /**
 * Address Firefox 3+ setting `line-height` on `input` using `!important` in
 * the UA stylesheet.
 */

        button,
        input {
            line-height: normal;
        }

        /**
 * Address inconsistent `text-transform` inheritance for `button` and `select`.
 * All other form control elements do not inherit `text-transform` values.
 * Correct `button` style inheritance in Chrome, Safari 5+, and IE 6+.
 * Correct `select` style inheritance in Firefox 4+ and Opera.
 */

        button,
        select {
            text-transform: none;
        }

        /**
 * 1. Avoid the WebKit bug in Android 4.0.* where (2) destroys native `audio`
 *    and `video` controls.
 * 2. Correct inability to style clickable `input` types in iOS.
 * 3. Improve usability and consistency of cursor style between image-type
 *    `input` and others.
 * 4. Remove inner spacing in IE 7 without affecting normal text inputs.
 *    Known issue: inner spacing remains in IE 6.
 */

        button,
        html input[type="button"],
        /* 1 */
        input[type="reset"],
        input[type="submit"] {
            -webkit-appearance: button;
            /* 2 */
            cursor: pointer;
            /* 3 */
            *overflow: visible;
            /* 4 */
        }

        /**
 * Re-set default cursor for disabled elements.
 */

        button[disabled],
        html input[disabled] {
            cursor: default;
        }

        /**
 * 1. Address box sizing set to content-box in IE 8/9.
 * 2. Remove excess padding in IE 8/9.
 * 3. Remove excess padding in IE 7.
 *    Known issue: excess padding remains in IE 6.
 */

        input[type="checkbox"],
        input[type="radio"] {
            box-sizing: border-box;
            /* 1 */
            padding: 0;
            /* 2 */
            *height: 13px;
            /* 3 */
            *width: 13px;
            /* 3 */
        }

        /**
 * 1. Address `appearance` set to `searchfield` in Safari 5 and Chrome.
 * 2. Address `box-sizing` set to `border-box` in Safari 5 and Chrome
 *    (include `-moz` to future-proof).
 */

        input[type="search"] {
            -webkit-appearance: textfield;
            /* 1 */
            -moz-box-sizing: content-box;
            -webkit-box-sizing: content-box;
            /* 2 */
            box-sizing: content-box;
        }

        /**
 * Remove inner padding and search cancel button in Safari 5 and Chrome
 * on OS X.
 */

        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        /**
 * Remove inner padding and border in Firefox 3+.
 */

        button::-moz-focus-inner,
        input::-moz-focus-inner {
            border: 0;
            padding: 0;
        }

        /**
 * 1. Remove default vertical scrollbar in IE 6/7/8/9.
 * 2. Improve readability and alignment in all browsers.
 */

        textarea {
            overflow: auto;
            /* 1 */
            vertical-align: top;
            /* 2 */
        }

        /**
 * Remove most spacing between table cells.
 */

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        html,
        button,
        input,
        select,
        textarea {
            color: #222;
        }


        ::-moz-selection {
            background: #b3d4fc;
            text-shadow: none;
        }

        ::selection {
            background: #b3d4fc;
            text-shadow: none;
        }

        img {
            vertical-align: middle;
        }

        fieldset {
            border: 0;
            margin: 0;
            padding: 0;
        }

        textarea {
            resize: vertical;
        }

        .chromeframe {
            margin: 0.2em 0;
            background: #ccc;
            color: #000;
            padding: 0.2em 0;
        }

        body {
            padding: 20px !important;
        }

        .header-right {
            margin-left: auto;
            text-align: right;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div style="display: flex;">
        <h2 style="font-size: 25px"><strong style="font-weight: bold;">#feed</strong>ThePoor</h2>
        <div class="header-right">
            <a href="https://www.feedthepoor.online" class="">www.feedthepoor.online</a><br>
            <a href="mailto:ceo@icrewsystems.org">ceo@icrewsystems.org</a>
        </div>
    </div>

    @foreach ($paydet as $payment)

    <div style="margin-top: 20px;">
        <p style="color: rgba(0,0,0,0.5);">Date: 17th August 2020</p><br>
        <p class="mt-5 lead">
            Dear <strong style="font-weight:600;">{{$payment->notes->name}}</strong>
        </p><br>
        <p>
            Thank you for valuable contribution towards meal for the poor and malnourished people in our country. Your
            donations will help us support those in need. You have our sincerest gratitude.
        </p>
        <p class="mt-3 lead"><br>
            Best wishes,
        </p>
        <p class="mt-3 lead">
            Leonard Selvaraja <br><span style="color: rgba(0,0,0,0.5);">CEO - icrewsystems Software Solutions LLP</span>
        </p>
    </div>

    <div style="text-align: center;">
        <h3 style="font-size: 16px; font-weight: bold;">Donation Receipt</h3>
        <span style="color: rgba(0,0,0,0.4);">(eigible for 80G tax deduction)</span>
    </div><br>

    <table style="table-layout: fixed; width:100%">
        <tr>
            <td>Receipt No.</td>
            <td>123456</td>
        </tr>
        <tr>
            <td>Payment ID:</td>
            <td>123456</td>
        </tr>
        <tr>
            <td>email:</td>
            <td>{{$payment->email}}</td>
        </tr>
        <tr>
            <td>Donor name and address</td>
            <td>{{$payment->notes->name}}<br> {{$payment->notes->address}}</td>
        </tr>
        <tr>
            <td>Transaction Date:</td>
            <td>{{$payment->created_at}}</td>
        </tr>
        <tr>
            <td>Amount Received:</td>
            <td>{{$payment->currency}} <strong>{{$payment->amount / 100}}</strong></td>
        </tr>
        <tr>
            <td>Payment Mode:</td>
            <td>Gold Coins</td>
        </tr>
    </table><br>

    @endforeach

    <p style="text-align: center;">
        (This is a computer generated invoice and does not require any stamp or signature)
    </p><br><br>


    <div>
        <p class="lead">
        <h3 style="font-size: 18px;">FeedThePoor</h3>
        <span style="color: rgba(0,0,0,0.4);">
            An initiative by Roshni Charitable Fund<br>
            Proudy sponsored by:<br>
            icrewsystems Software Solutions LLP, India<br>
            GemHosting, United Kingdom
        </span>
        </p>
    </div>
</body>

</html>
