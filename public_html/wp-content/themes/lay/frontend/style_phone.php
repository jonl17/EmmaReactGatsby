<?php
return
'
.tagline {
  display: none; }

body {
  -webkit-box-sizing: border-box;
          box-sizing: border-box; }

.fp-section.row._100vh, .fp-section.row._100vh.empty {
  min-height: 0; }
  .fp-section.row._100vh .row-inner, .fp-section.row._100vh.empty .row-inner {
    min-height: 0 !important; }

.nocustomphonegrid .col {
  width: 100%;
  margin: 0 0 5% 0;
  -webkit-transform: translate(0, 0) !important;
      -ms-transform: translate(0, 0) !important;
          transform: translate(0, 0) !important; }

html.flexbox .nocustomphonegrid .row._100vh.one-col-row .column-wrap {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex; }

html.flexbox .nocustomphonegrid .row._100vh.one-col-row .col.align-middle {
  -webkit-align-self: center;
  -ms-flex-item-align: center;
      align-self: center;
  position: relative; }

html.flexbox .nocustomphonegrid .row._100vh.one-col-row .col.align-bottom {
  -webkit-align-self: flex-end;
  -ms-flex-item-align: end;
      align-self: flex-end;
  position: relative; }

html.flexbox .nocustomphonegrid .row._100vh.one-col-row .col.align-top {
  -webkit-align-self: flex-start;
  -ms-flex-item-align: start;
      align-self: flex-start;
  position: relative; }

.nocustomphonegrid .row {
  padding-left: 5vw;
  padding-right: 5vw;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  display: block; }

.nocustomphonegrid .row:last-child .col:last-child {
  margin-bottom: 0 !important; }

html.flexbox .hascustomphonegrid .column-wrap {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex; }

html.flexbox .hascustomphonegrid .col.align-middle {
  -webkit-align-self: center;
  -ms-flex-item-align: center;
      align-self: center;
  position: relative; }

html.flexbox .hascustomphonegrid .col.align-top {
  -webkit-align-self: flex-start;
      -ms-flex-item-align: start;
          align-self: flex-start; }

html.flexbox .hascustomphonegrid .col.align-bottom {
  -webkit-align-self: flex-end;
      -ms-flex-item-align: end;
          align-self: flex-end; }

html.no-flexbox .hascustomphonegrid .col.align-middle {
  position: relative;
  vertical-align: top; }

html.no-flexbox .hascustomphonegrid .col.align-top {
  vertical-align: top; }

html.no-flexbox .hascustomphonegrid .col.align-bottom {
  vertical-align: bottom; }

.row-inner {
  -webkit-box-sizing: border-box;
          box-sizing: border-box; }

.title a, .title {
  opacity: 1; }

.sitetitle {
  display: none; }

.navbar {
  display: block;
  top: 0;
  left: 0;
  bottom: auto;
  right: auto;
  width: 100%;
  z-index: 30;
  border-bottom-style: solid;
  border-bottom-width: 1px; }

.mobile-title.image {
  font-size: 0; }

.mobile-title.text {
  line-height: 1;
  display: -webkit-inline-box;
  display: -webkit-inline-flex;
  display: -ms-inline-flexbox;
  display: inline-flex; }
  .mobile-title.text > span {
    -webkit-align-self: center;
        -ms-flex-item-align: center;
            align-self: center; }

.mobile-title {
  z-index: 31;
  display: inline-block;
  -webkit-box-sizing: border-box;
          box-sizing: border-box; }
  .mobile-title img {
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    height: 100%; }

nav.primary, nav.second_menu, nav.third_menu, nav.fourth_menu {
  display: none; }

body.use-desktop-menu-as-mobile-menu .burger {
  display: none; }

body.use-desktop-menu-as-mobile-menu nav.mobile-nav {
  z-index: 35;
  line-height: 1;
  white-space: nowrap; }
  body.use-desktop-menu-as-mobile-menu nav.mobile-nav li {
    vertical-align: top; }
  body.use-desktop-menu-as-mobile-menu nav.mobile-nav li:last-child {
    margin-right: 0 !important;
    margin-bottom: 0 !important; }
  body.use-desktop-menu-as-mobile-menu nav.mobile-nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    font-size: 0; }
  body.use-desktop-menu-as-mobile-menu nav.mobile-nav a {
    text-decoration: none; }
  body.use-desktop-menu-as-mobile-menu nav.mobile-nav span {
    border-bottom-style: solid;
    border-bottom-width: 0; }

body.use-mobile-menu nav.mobile-nav.transition {
  -webkit-transition: -webkit-transform 400ms ease;
  transition: -webkit-transform 400ms ease;
  -o-transition: transform 400ms ease;
  transition: transform 400ms ease;
  transition: transform 400ms ease, -webkit-transform 400ms ease; }

body.use-mobile-menu nav.mobile-nav::-webkit-scrollbar {
  display: none; }

body.use-mobile-menu nav.mobile-nav {
  overflow-y: scroll;
  -webkit-overflow-scrolling: touch;
  white-space: normal;
  width: 100%;
  left: 0;
  bottom: auto;
  -webkit-transform: translateY(-99999px);
      -ms-transform: translateY(-99999px);
          transform: translateY(-99999px); }
  body.use-mobile-menu nav.mobile-nav .current-menu-item {
    opacity: 1; }
  body.use-mobile-menu nav.mobile-nav li {
    text-align: center;
    display: block;
    margin-right: 0;
    margin-bottom: 0;
    padding: 0; }
    body.use-mobile-menu nav.mobile-nav li a {
      display: block;
      padding: 10px;
      opacity: 1;
      border-bottom-style: solid;
      border-bottom-width: 1px;
      -webkit-transition: background-color 200ms ease;
      -o-transition: background-color 200ms ease;
      transition: background-color 200ms ease;
      margin: 0;
      text-align: center; }
    body.use-mobile-menu nav.mobile-nav li a:hover {
      opacity: 1; }
    body.use-mobile-menu nav.mobile-nav li a .span-wrap {
      border-bottom: none; }
    body.use-mobile-menu nav.mobile-nav li a:hover .span-wrap {
      border-bottom: none; }

.html5video .html5video-customplayicon {
  max-width: 100px; }

.hascustomphonegrid ._100vh :not(.stack-element) > .col[data-type="text"] {
  position: absolute !important;
  margin-left: 0 !important;
  z-index: 1; }

.hascustomphonegrid ._100vh :not(.stack-element) > .col[data-type="text"].align-top {
  top: 0; }

.hascustomphonegrid ._100vh :not(.stack-element) > .col[data-type="text"].align-middle {
  top: 50%;
  -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
          transform: translateY(-50%); }

.hascustomphonegrid ._100vh :not(.stack-element) > .col[data-type="text"].align-bottom {
  bottom: 0; }

';