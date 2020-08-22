import React, { useEffect } from "react"
import "./fonts.css"
import { GlobalStyles } from "../components/GlobalStyles"

/** components */
import { Container } from "./Styled"
import Copyright from "../components/Copyright"

const Layout = ({ children }) => {
  return (
    <>
      <GlobalStyles></GlobalStyles>
      <Container>{children}</Container>
      <Copyright></Copyright>
    </>
  )
}

export default Layout
