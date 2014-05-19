//
//  ILTMusculoTableViewCell.m
//  iLiftTec
//
//  Created by Ivan Diaz on 3/27/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import "ILTMusculoTableViewCell.h"
#import "ILTJsonManager.h"
#import "ILTMasterViewController.h"

@implementation ILTMusculoTableViewCell

- (id)initWithStyle:(UITableViewCellStyle)style reuseIdentifier:(NSString *)reuseIdentifier
{
    self = [super initWithStyle:style reuseIdentifier:reuseIdentifier];
    if (self) {
        // Initialization code
    }
    return self;
}

- (void)awakeFromNib
{
    // Initialization code
}

- (void)setSelected:(BOOL)selected animated:(BOOL)animated
{
    [super setSelected:selected animated:animated];

    // Configure the view for the selected state
}

- (IBAction)checkButton:(id)sender {
    
    self.buttonIsOn = !self.buttonIsOn;
    NSMutableArray *auxDic = [_delegado definicion];
    NSUserDefaults *fetchDefaults = [NSUserDefaults standardUserDefaults];
    NSString *user = [fetchDefaults objectForKey:@"kUser"];
    NSString *pass = [fetchDefaults objectForKey:@"kPassword"];
    
    NSString *post =[[NSString alloc] initWithFormat:@"idAlumno=%@&contrasena=%@",user,pass];
    NSString *url = @"http://localhost/~ivandiaz/servidor/obtenerJson.php";
    ILTJsonManager *JsonManager = [[ILTJsonManager alloc] init];
    NSDictionary *jsonData = [JsonManager jsonHandler:url parametros:post];
    NSMutableArray *_definicion;
    _definicion = jsonData[@"dias"];
    
    
    
    [self updateImage];
    [self.papa updateDia: self.section ejercicio: self.row completado: self.buttonIsOn];
    
    
}

-(void) updateImage{
    if(self.buttonIsOn){
        UIImage *btnImage1 = [UIImage imageNamed:@"checkbox-checked.png"];
        [self.checkB setImage:btnImage1 forState:UIControlStateNormal];
    } else{
        UIImage * btnImage2 = [UIImage imageNamed:@"checkbox-unchecked.png"];
        [self.checkB setImage:btnImage2 forState:UIControlStateNormal];
    }
}
@end
