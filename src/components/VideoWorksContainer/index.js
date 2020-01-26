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

const VideoContainer = ({ artwork, device }) => {
  const { description, video, material, year } = artwork.acf
  return (
    <ContainerStyled device={device}>
      <ExitBtn></ExitBtn>
      <TitleContainer device={device}>
        <Title>{artwork.title.replace("#038;", "")}</Title>
        <Year device={device}>{year}</Year>
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

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(VideoContainer)
