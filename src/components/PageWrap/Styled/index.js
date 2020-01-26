import styled, { css } from "styled-components"

export const PageWrapStyle = styled.div`
    box-sizing: border-box;
    max-width: 750px;
    margin: auto;
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
      props.device === `mobile` &&
      css`
        padding: 25px;
      `}
`
