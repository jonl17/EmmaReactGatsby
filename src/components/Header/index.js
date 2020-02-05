import React from "react"
import { useSelector, useDispatch } from "react-redux"
import { graphql, StaticQuery } from "gatsby"
import { setPagenamePrefix } from "../../state/actions"

/** components */
import Menu from "./components/Menu"
import { Container, Title } from "./Styled"

const Header = ({
  data: {
    site: {
      siteMetadata: { menuItems, title },
    },
  },
}) => {
  const device = useSelector(state => state.reducer.device)
  const dispatch = useDispatch()
  return (
    <Container device={device}>
      <Title
        device={device}
        onClick={() => dispatch(setPagenamePrefix(""))}
        to="/"
      >
        {title}
      </Title>
      <Menu items={menuItems}></Menu>
    </Container>
  )
}

export default props => (
  <StaticQuery
    query={graphql`
      {
        site {
          siteMetadata {
            menuItems {
              name
              slug
            }
            title
          }
        }
      }
    `}
    render={data => <Header data={data} {...props}></Header>}
  ></StaticQuery>
)
