import styled, { css } from "styled-components"
import { Link } from "gatsby"

export const Container = styled.div`
  display: flex;
  justify-content: space-between;
  width: 300px;
  ${props =>
    props.device === `mobile` &&
    css`
      margin: auto;
    `}
`
export const Text = styled.p``
export const Item = styled(Link)`
  text-decoration: none;
  color: inherit;
`
