import React from "react"
import styled, { css } from "styled-components"
import { connect } from "react-redux"

const PageWrapStyle = styled.div`
  box-sizing: border-box;
  max-width: 750px;

  ${props =>
    props.device === `browser` &&
    css`
      padding: 25px 50px;
    `}
  ${props =>
    props.device === `tablet` &&
    css`
      padding: 25px 50px;
    `}
  ${props =>
    props.device === `mobileL` &&
    css`
      padding: 25px;
    `}
  ${props =>
    props.device === `mobileS` &&
    css`
      padding: 0 25px;
    `}
`

const PageWrap = ({ children, device }) => (
  <PageWrapStyle device={device}>{children}</PageWrapStyle>
)

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(PageWrap)
