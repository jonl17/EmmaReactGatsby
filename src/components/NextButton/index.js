import React from "react"
import { connect } from "react-redux"
import { Link } from "gatsby"
import { setCurrentWorkIndex } from "../../state/actions"

import styled from "styled-components"

const Button = styled(Link)`
  text-decoration: none;
  text-align: right;
`

const NextButton = ({ works, nextWorkIndex, dispatch }) => {
  return (
    <Button
      onClick={() => dispatch(setCurrentWorkIndex(nextWorkIndex))}
      to={"/" + works[nextWorkIndex].node.slug}
    >
      <p style={{ color: "black" }}>
        Next work: {works[nextWorkIndex].node.title}
      </p>
    </Button>
  )
}

const mapStateToProps = state => ({
  works: state.reducer.works,
  nextWorkIndex: state.reducer.nextWorkIndex,
})

export default connect(mapStateToProps)(NextButton)
