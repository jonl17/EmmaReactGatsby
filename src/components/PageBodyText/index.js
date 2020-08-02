import React from "react"
import { RichText } from "prismic-reactjs"

const PageBodyText = ({ slice }) => {
  return slice.primary && <RichText render={slice.primary.text} />
}

export default PageBodyText
