import React from "react"

/** components */
import { Text } from "./Styled"

const Copyright = props => {
  const d = new Date()
  return <Text>© Emma Heiðarsdóttir | {d.getFullYear()}</Text>
}

export default Copyright
