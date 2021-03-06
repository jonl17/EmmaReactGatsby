import styled, { css } from "styled-components"
import { Link } from "gatsby"

export const Container = styled.div`
  height: 150px;
  width: 100%;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  justify-content: center;
  box-sizing: border-box;
  ${props =>
    props.device === `browser` &&
    css`
      padding: 25px 0 25px 50px;
    `}
  ${props =>
    props.device === `mobile` &&
    css`
      padding: 65px 15px 15px;
    `}
`

export const Title = styled(Link)`
  font-size: 25px;
  text-decoration: none;
  color: black;
  ${props =>
    props.device === `mobile` &&
    css`
      margin-right: auto;
      padding-left: 22px;
    `}
`
