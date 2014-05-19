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
    NSLog(@"IVAN");
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
    NSString *valor;
    if (self.buttonIsOn) {
        valor = @"1";
    }else{
        valor = @"0";
    }
    
    [[[_delegado definicion][_indexPath.section] objectForKey:@"ejercicios"][_indexPath.row] setValue:valor forKey:@"avance"];
    
    NSDictionary *nueva = [[NSDictionary alloc] initWithObjectsAndKeys:[_delegado definicion], @"dias", nil];
    
    NSError *error;
    NSData *jsonData = [NSJSONSerialization dataWithJSONObject:nueva
                                                       options:NSJSONWritingPrettyPrinted
                                                         error:&error];
    
    if (! jsonData) {
        NSLog(@"Got an error: %@", error);
    } else {
        NSString *jsonString = [[NSString alloc] initWithData:jsonData encoding:NSUTF8StringEncoding];
        
        NSUserDefaults *fetchDefaults = [NSUserDefaults standardUserDefaults];
        NSString *user = [fetchDefaults objectForKey:@"kUser"];
        NSString *pass = [fetchDefaults objectForKey:@"kPassword"];
        
        NSString *post =[[NSString alloc] initWithFormat:@"idAlumno=%@&contrasena=%@&json=%@", user, pass, jsonString];
        NSString *url = @"http://localhost/~ivandiaz/servidor/actualizarRutina.php";
        ILTJsonManager *JsonManager = [[ILTJsonManager alloc] init];
        NSDictionary *jsonData1 = [JsonManager jsonHandler:url parametros:post];
        
    }
    

    
    [self updateImage];
    //[self.papa updateDia: self.section ejercicio: self.row completado: self.buttonIsOn];
    
    
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
