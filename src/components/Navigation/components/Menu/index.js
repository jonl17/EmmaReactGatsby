import React from "react"

/** components */
import { Container, Item, Text } from "./Styled"

const Menu = ({ items }) => {
  return (
    <Container>
      {items.map((item, index) => (
        <Text key={index}>
          <Item activeStyle={{ color: "black" }} to={item.slug}>
            {item.name}
          </Item>
        </Text>
      ))}
    </Container>
  )
}

export default Menu
