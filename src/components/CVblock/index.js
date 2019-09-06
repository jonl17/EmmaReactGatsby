import styled, { keyframes, css } from "styled-components"

export const Block = styled.div`
  width: 100%;
`
export const Title = styled.p`
  color: black;
  font-size: 20px;
  margin-bottom: 0;
`

const goldShine = keyframes`
  from {
    color: gray;
  }
  to {
    color: gold;
  }
`
export const Item = styled.p`
  margin: 0;
  ${props =>
    props.upcoming === true &&
    css`
      animation: ${goldShine} 1s infinite alternate;
    `}
`
