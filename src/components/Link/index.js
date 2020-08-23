import React from "react"
import { Link as GatsbyLink } from "gatsby"
import "./styles.scss"

const Link = props => {
  return <GatsbyLink {...props}>{props.children}</GatsbyLink>
}

export default Link
