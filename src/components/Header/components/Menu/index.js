import React from "react"
import { useSelector, useDispatch } from "react-redux"
import { setPagenamePrefix } from "../../../../state/actions"

/** components */
import { Container, Item, Text } from "./Styled"

const Menu = ({ items }) => {
  const device = useSelector(state => state.reducer.device)
  const dispatch = useDispatch()
  console.log(device)
  return (
    <Container device={device}>
      {items.map((item, index) => (
        <Text key={index}>
          <Item
            onClick={() => dispatch(setPagenamePrefix(""))}
            activeStyle={{ color: "black" }}
            to={item.slug}
          >
            {item.name}
          </Item>
        </Text>
      ))}
    </Container>
  )
}

export default Menu
