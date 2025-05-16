import pygame

pygame.init()

BREDDE, HØYDE = 800, 600
SKJERM = pygame.display.set_mode((BREDDE, HØYDE))

blokk_x, blokk_y = 0, 250
blokk_x1, blokk_y1 = 750, 250
ball_x, ball_y = 375, 275
fart = 15
ball_fartx, ball_farty = 13, 13

spiller1_poeng = 0
spiller2_poeng = 0

SVART = (0, 0, 0)
HVIT = (255, 255, 255)


aktiv = True

while aktiv:
    SKJERM.fill(SVART)

    for hendelse in pygame.event.get():
        if hendelse.type == pygame.QUIT:
            aktiv = False


    font = pygame.font.SysFont(None, 24)
   
    poeng1 = f'{spiller1_poeng}'
    cords = font.render(poeng1, True, (255,255,255))
    SKJERM.blit(cords, (80, 20))

    poeng2 = f'{spiller2_poeng}'
    cords = font.render(poeng2, True, (255,255,255))
    SKJERM.blit(cords, (BREDDE - 90, 20))

    tittel = f'Pong'
    cords = font.render(tittel, True, (255,255,255))
    SKJERM.blit(cords, (BREDDE/2 - 20, 20))

    if spiller1_poeng==15:
        vinner1 = f'Spiller 1 Vinner'
        cords = font.render(vinner1, True, (255,255,255))
        SKJERM.blit(cords, (BREDDE/2 - 45, 50))
        ball_fartx = 0
        ball_farty = 0

    if spiller2_poeng==15:
        vinner2 = f'Spiller 2 Vinner'
        cords = font.render(vinner2, True, (255,255,255))
        SKJERM.blit(cords, (BREDDE/2 - 45, 50))
        ball_fartx = 0
        ball_farty = 0
        

    pygame.font.init()

    taster = pygame.key.get_pressed()

    if taster[pygame.K_w] and blokk_y > 0:  
            blokk_y -= fart
    if taster[pygame.K_s] and blokk_y < HØYDE - 150:  
            blokk_y += fart

    if taster[pygame.K_UP] and blokk_y1 > 0:
            blokk_y1 -= fart
    if taster[pygame.K_DOWN] and blokk_y1 < HØYDE - 150:
            blokk_y1 += fart

    ball_x += ball_fartx
    ball_y += ball_farty
    
    if ball_y <= 0 or ball_y >= HØYDE - 20:
        ball_farty *= -1  

    
    if ball_x <= blokk_x + 50 and blokk_y < ball_y < blokk_y + 150:
        ball_fartx *= -1 

    
    if ball_x >= blokk_x1 - 20 and blokk_y1 < ball_y < blokk_y1 + 150:
        ball_fartx *= -1  

   
    if ball_x <= 0:
        ball_x, ball_y = 375, 275  
        ball_fartx *= -1
        spiller2_poeng += 1

    if ball_x >= BREDDE:
        ball_x, ball_y = 375, 275  
        ball_fartx *= -1
        spiller1_poeng += 1


    pygame.draw.rect(SKJERM, HVIT, (ball_x, ball_y, 20, 20))
    pygame.draw.rect(SKJERM, HVIT, (blokk_x, blokk_y, 50, 150))
    pygame.draw.rect(SKJERM, HVIT, (blokk_x1, blokk_y1, 50, 150))

    pygame.display.flip()
    pygame.time.delay(30)

pygame.quit()