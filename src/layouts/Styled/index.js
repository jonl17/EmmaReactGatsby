import styled, { css } from "styled-components"

export const Container = styled.div`
  height: 100%;
  min-height: 100vh;
  width: 100%;
  opacity: 0;
  transition: 0.2s;
  opacity: 0;
  ${props =>
    props.show &&
    css`
      opacity: 1;
    `}
`
