import React from "react"
import { Link as GatsbyLink } from "gatsby"
import "./styles.scss"

const Link = ({ children, to, className, activeClassName }) => {
  return (
    <GatsbyLink to={to} className={className} activeClassName={activeClassName}>
      {children}
    </GatsbyLink>
  )
}

export default Link
