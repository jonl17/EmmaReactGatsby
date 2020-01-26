import React from "react"
import { useSelector, useDispatch } from "react-redux"
import { setCurrentWorkIndex } from "../../state/actions"
import { graphql, StaticQuery } from "gatsby"

/** components */
import { Button, Text } from "./Styled"

const NextButton = ({
  data: {
    allWordpressWpWorks: { edges: works },
  },
}) => {
  const nextWorkIndex = useSelector(state => state.reducer.nextWorkIndex)
  const dispatch = useDispatch()
  if (nextWorkIndex === works.length) {
    dispatch(setCurrentWorkIndex(0))
  }
  if (works[nextWorkIndex] === undefined) {
    return <p>""</p>
  }
  return (
    <Button
      onClick={() => {
        dispatch(setCurrentWorkIndex(nextWorkIndex))
      }}
      to={"/Works/" + works[nextWorkIndex].node.slug}
    >
      <Text>
        Next work: {works[nextWorkIndex].node.title.replace("#038;", "")}
      </Text>
    </Button>
  )
}

export default props => (
  <StaticQuery
    query={graphql`
      {
        allWordpressWpWorks(sort: { fields: date, order: DESC }) {
          edges {
            node {
              date
              title
              slug
            }
          }
        }
      }
    `}
    render={data => <NextButton data={data} {...props}></NextButton>}
  ></StaticQuery>
)
