function DrawMap()
{
    mapIndex = 0;
            Context.context.font = "20px Arial";
            for (var y = 0; y < dim; y++)
            {
                for (var x = 0; x < dim; x++, mapIndex++)
                {
                    var tile_x = x * BLOCK_W;
                    var tile_y = y * BLOCK_H;

                    tileType = map[mapIndex];
                    if(y == dim && x == dim){
                        tresaure.draw(tile_x, tile_y);
                    }
                    if (tileType == 'W' || tileType == 'W,W'){
                        water.draw(tile_x, tile_y);

                    }
                    else if(tileType == 'T'){
                        wall.draw(tile_x, tile_y);
                    }
                    else if(tileType.includes('W,')){
                        cross_two.draw(tile_x, tile_y);
                        splitted = tileType.split(",");
                        Context.context.fillText(splitted[1],tile_x+40, tile_y+52);
                    }
                    else if(tileType.includes(',W')){
                        cross_one.draw(tile_x, tile_y);
                        splitted = tileType.split(",");
                        Context.context.fillText(splitted[0],tile_x+38, tile_y+55);
                    }
                    else if(tileType.includes(',')){
                        cross_both.draw(tile_x, tile_y);
                        splitted = tileType.split(",");
                        Context.context.fillText(splitted[1],tile_x+55, tile_y+32);
                        Context.context.fillText(splitted[0],tile_x+53, tile_y+72);
                    }
                    else if(tileType.includes('E')){
                        tresure.draw(tile_x, tile_y);
                        
                    }
                    else if(tileType.includes('S')){
                        flag.draw(tile_x, tile_y);
                    }
                    else{
                        if(!(x%2)){
                            cross_vr.draw(tile_x, tile_y);
                            Context.context.fillText(tileType,tile_x+34, tile_y+55);
                        } else{
                            cross_hz.draw(tile_x, tile_y);
                            Context.context.fillText(tileType,tile_x+35, tile_y+53);
                        }
                        
                    }
                }
            }
}