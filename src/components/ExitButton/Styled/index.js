import styled, { css } from "styled-components"

export const NewExitButton = styled.div`
z-index: 8;
  height: 30px;
  width: 30px;
  position: fixed;
  ${props =>
    props.device === `browser` &&
    css`
      right: 35px;
      top: 35px;
    `}
  ${props =>
    props.device === `tablet` &&
    css`
      right: 20px;
      top: 20px;
    `}
  ${props =>
    props.device === `mobile` &&
    css`
      right: 20px;
      top: 20px;
    `}

  &:hover {
    cursor: pointer;
  }
  display: ${props => props.display};
  flex-direction: column;
`
export const Line = styled.span`
  background: black;
  width: 100%;
  height: 4px;
  box-sizing: border-box;
  position: absolute;
  top: 50%;
  margin-top: -5px;
  transform: ${props => (props.differ ? "rotate(45deg)" : "rotate(-45deg)")};
`
