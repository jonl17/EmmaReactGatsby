import React from "react"

import ExitBtn from "../ExitButton"
import NextBtn from "../NextButton"

import { connect } from "react-redux"

import {
  ContainerStyled,
  TitleContainer,
  Year,
  Title,
  DescriptionBox,
} from "../WorksContainer/Styled"

import { Container, Video } from "./Styled"

const VideoContainer = ({ artwork }) => {
  const { description, video, material, year } = artwork.acf
  return (
    <ContainerStyled>
      <ExitBtn></ExitBtn>
      <TitleContainer>
        <Title>{artwork.title.replace("#038;", "")}</Title>
        <Year>{year}</Year>
      </TitleContainer>
      <DescriptionBox>
        <p>{description}</p>
        <p>{material}</p>
      </DescriptionBox>
      <Container>
        <Video src={video}></Video>
      </Container>
      <NextBtn></NextBtn>
    </ContainerStyled>
  )
}

export default VideoContainer
