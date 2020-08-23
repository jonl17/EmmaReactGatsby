import React, { useEffect } from "react"
import "./fonts.css"
import "./global.scss"

/** components */
import { Container } from "./Styled"
import Copyright from "../components/Copyright"
import Navigation from "../components/Navigation"

const Layout = ({ children }) => {
  return (
    <>
      <Navigation />
      <div className="container">{children}</div>
      <Copyright></Copyright>
    </>
  )
}

export default Layout
