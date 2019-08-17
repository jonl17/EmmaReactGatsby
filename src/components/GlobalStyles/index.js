import { createGlobalStyle } from "styled-components"
import Balkan from "./Balkan.otf"
// import Cursor from "../../../static/cursor-normal.png"

export const GlobalStyles = createGlobalStyle`
    @font-face {
        font-family: Balkan;
        src: url('${Balkan}') format('opentype');
    }
    * {
        font-family: Balkan;
        font-weight: normal;
    }
    html, body {
        margin: 0;
    }
    p {
        color: gray;
        line-height: 1.6;
    }
`
