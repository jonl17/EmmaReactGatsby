import { createGlobalStyle } from "styled-components"

export const GlobalStyles = createGlobalStyle`
    html, body {
        margin: 0;
    }
    p {
        color: gray;
        line-height: 1.6;
    }
    ::selection {
        color: gold;
    }
`
